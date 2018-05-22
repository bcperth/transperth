<?php
/* overrides default paginator templates defined in \vendor\cakephp\cakephp\src\View\Helper\PaginatorHelper.php*/
return [
    'nextActive'     => '<li class="page-item"><a class="page-link" rel="next" href="{{url}}">{{text}}</a></li>',
    'nextDisabled'   => '<li class="page-item disabled"><a class="page-link" href="" onclick="return false;">{{text}}</a></li>',
    'prevActive'     => '<li class="page-item"><a class="page-link" rel="prev" href="{{url}}">{{text}}</a></li>',
    'prevDisabled'   => '<li class="page-item disabled"><a class="page-link" href="" onclick="return false;">{{text}}</a></li>',
    'first'          => '<li class="page-item"><a class="page-link" href="{{url}}">{{text}}</a></li>',
    'last'           => '<li class="page-item"><a class="page-link" href="{{url}}">{{text}}</a></li>',
    'number'         => '<li class="page-item"><a class="page-link" href="{{url}}">{{text}}</a></li>',
    'current'        => '<li class="page-item active"><a class="page-link" href="">{{text}}</a></li>',
];
