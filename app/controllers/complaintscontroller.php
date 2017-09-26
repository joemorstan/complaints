<?php

class ComplaintsController extends Controller {

    public function index($page = 1, $orderBy = 'created_at', $order = 'DESC')
    {
        $complaint = $this->loadModel('Complaint');

        $data = $complaint->paginate($page, $orderBy, $order);

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

        //ip info
        $data['ip'] = $this->getClientIp();

        //browser data
        $data['browser'] = $_SERVER['HTTP_USER_AGENT'];


        $complaint = $this->loadModel('Complaint');
        $complaint->save($data);

        $this->jsonSuccessResponse(URL. 'complaints/page/1');
    }

    public function create()
    {
        $this->view('complaint/complaint_create');
    }

    public function show($id)
    {
        $id = (int) $id;

        $complaints = $this->loadModel('Complaint');

        $item = $complaints->findById($id);

        $this->view('proposition_complaint_show', $item);
    }

    public function edit($id)
    {
        $id = (int) $id;

        if (!Auth::check()) {
            header('Location: '. URL);
            exit;
        }

        $complaint = $this->loadModel('Complaint');

        $item = $complaint->findById($id);

        $this->view('complaint/complaint_edit', $item);
    }

    public function update()
    {
        if (!Auth::check() or !Auth::canWrite()) {
            header('Location: '. URL);
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

        if (empty($_POST['content'])) {
            $this->jsonErrorResponse('Please fill a message field');
        }
        $data['content'] = $this->filterText($_POST['content']);

        $complaint = $this->loadModel('Complaint');

        if ($complaint->update($id, $data)) {
            $this->jsonSuccessResponse('Complaint was successfully updated');
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

        $complaint = $this->loadModel('Complaint');

        $complaint->delete($id);

        header('Location: ', URL);

    }

}