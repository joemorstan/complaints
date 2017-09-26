<ul class="pagination">

    <li class="page-item <?= $data['currentPage'] == 1 ? 'disabled' : ''?> ">
        <a class="page-link"
           href="<?= $data['currentPage'] == 1 ? '#' : URL. $data['topic'] .'/page/'. ($data['currentPage'] - 1). '/'. $data['orderBy']. '/'. $data['order'] ?>">
            Previous
        </a>
    </li>

    <?php

    if ($data['totalPages'] <= 9) {

        for ($i = 1; $i <= $data['totalPages']; $i++) {

            if ($i == $data['currentPage']) {
                echo Paginator::liActive($i, $data['topic'], $data['orderBy'], $data['order']);
            } else {
                echo Paginator::liNotActive($i, $data['topic'], $data['orderBy'], $data['order']);
            }
        }

    } elseif (
        $data['totalPages'] > 9 &&
        $data['currentPage'] <= 5
    ) {

        for ($i = 1; $i <= 9; $i++) {
            if ($i == $data['currentPage']) {
                echo Paginator::liActive($i, $data['topic'], $data['orderBy'], $data['order']);
            } else {
                echo Paginator::liNotActive($i, $data['topic'], $data['orderBy'], $data['order']);
            }
        }

      } elseif (
          $data['totalPages'] > 9 &&
          $data['currentPage'] > 5 &&
          $data['totalPages'] - $data['currentPage'] >= 5
    ) {

        for ($i = $data['currentPage'] - 4; $i <= $data['currentPage'] + 4; $i++) {
            if ($i == $data['currentPage']) {
                echo Paginator::liActive($i, $data['topic'], $data['orderBy'], $data['order']);
            } else {
                echo Paginator::liNotActive($i, $data['topic'], $data['orderBy'], $data['order']);
            }
        }

    } elseif (
        $data['totalPages'] > 9 &&
        $data['currentPage'] > 5 &&
        $data['totalPages'] - $data['currentPage'] < 5
    ) {

        for ($i = $data['totalPages'] - 8; $i <= $data['totalPages']; $i++) {
            if ($i == $data['currentPage']) {
                echo Paginator::liActive($i, $data['topic'], $data['orderBy'], $data['order']);
            } else {
                echo Paginator::liNotActive($i, $data['topic'], $data['orderBy'], $data['order']);
            }
        }

    }

    ?>

    <li class="page-item <?= $data['currentPage'] == $data['totalPages'] ? 'disabled' : ''?>">
        <a class="page-link"
           href="<?= $data['currentPage'] == $data['totalPages'] ? '#' : URL. $data['topic'] .'/page/'. ($data['currentPage'] + 1). '/'. $data['orderBy']. '/'. $data['order'] ?>">
            Next
        </a>
    </li>
</ul>