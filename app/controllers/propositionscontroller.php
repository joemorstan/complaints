<?php

class PropositionsController extends Controller {

    public function index($page = 1, $orderBy = 'created_at', $order = 'DESC')
    {
        $propositions = $this->loadModel('Proposition');

        $data = $propositions->paginate($page, $orderBy, $order, 5);

        $this->view('propositions_complaints_view', $data);
    }

    public function store()
    {
        //reCaptcha
        if (empty($_POST['g-recaptcha-response'])) {
            $this->jsonErrorResponse('Please verify captcha');
        }
        $response = $_POST['g-recaptcha-response'];
        $remoteIp = $_SERVER['REMOTE_ADDR'];

        $url = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=". RECAPTCHA_SECRET. "&response=$response&remoteip=$remoteIp");

        if(!json_decode($url)->success) {
            $this->jsonErrorResponse('Please verify captcha');
        };
        //end reCaptcha

        $data = array();

        //input name validation
        if (empty($_POST['name'])) {
            $this->jsonErrorResponse('Please insert a valid name');
        }
        $data['name'] = $this->filterText($_POST['name']);

        //input email validation
        if (empty($_POST['email']) || !$data['email'] = $this->filterEmail($_POST['email'])) {
            $this->jsonErrorResponse('Please insert a valid email');
        }

        //input url validation
        if (!empty($_POST['url']) && !$data['url'] = $this->filterUrl($_POST['url'])) {
            $this->jsonErrorResponse('Please insert a valid url');
        }

        if (empty($_POST['content'])) {
            $this->jsonErrorResponse('Please fill a message field');
        }
        $data['content'] = $this->filterText($_POST['content']);


        $propositions = $this->loadModel('Proposition');
        $propositions->save($data);

        $this->jsonSuccessResponse(URL. 'propositions');
    }

    public function create()
    {
        $this->view('proposition/proposition_create');
    }

    public function show($id)
    {
        $id = (int) $id;

        $proposition = $this->loadModel('Proposition');

        $item = $proposition->findById($id);

        $this->view('proposition_complaint_show', $item);
    }

    public function edit($id)
    {
        if (!Auth::check()) {
            header('Location: '. URL);
            exit;
        }

        $proposition = $this->loadModel('Proposition');

        $item = $proposition->findById($id);

        $this->view('proposition/proposition_edit', $item);
    }

    public function update()
    {
        if (!Auth::check() or !Auth::canWrite()) {
            $this->jsonErrorResponse('Access denied');
            exit;
        }


        $data = array();


        $id = (int) $_POST['id'];

        //input name validation
        if (empty($_POST['name'])) {
            $this->jsonErrorResponse('Please insert a valid name');
        }
        $data['name'] = $this->filterText($_POST['name']);

        //input email validation
        if (empty($_POST['email']) || !$data['email'] = $this->filterEmail($_POST['email'])) {
            $this->jsonErrorResponse('Please insert a valid email');
        }

        //input url validation
        if (!empty($_POST['url']) && !$data['url'] = $this->filterUrl($_POST['url'])) {
            $this->jsonErrorResponse('Please insert a valid url');
        }

        //input content
        if (empty($_POST['content'])) {
            $this->jsonErrorResponse('Please fill a message field');
        }
        $data['content'] = $this->filterText($_POST['content']);

        //ip info
        $data['ip'] = $this->getClientIp();

        //browser data
        $data['browser'] = $data['browser'] = $_SERVER['HTTP_USER_AGENT'];

        $proposition = $this->loadModel('Proposition');

        if ($proposition->update($id, $data)) {
            $this->jsonSuccessResponse('Proposition was successfully updated');
        } else {
            $this->jsonErrorResponse('Could not update');
        }
    }

    public function delete($id)
    {
        $id = (int) $id;

        if (!Auth::check()) {
            header('Location: '. URL);
            exit;
        }

        $proposition = $this->loadModel('Proposition');

        $proposition->delete($id);
    }
}