<?php

namespace App\Model\Facades;
use PaginateRoute;

class Pagination {

    public static function defaultPagination($paginator)
    {

        $paginator->onEachSide(null);
        $onEachSide = $paginator->onEachSide;
   
        $pagination = $paginator->render();
        $pagination = preg_replace("/page\/(\d+)\?page=(\d+)/", 'page/$2', $pagination);
        $pagination = str_replace('?page=', '/page/', $pagination);        
        $pagination = str_replace('<li class="active">', '<li class="active page-item">', $pagination);
        $pagination = str_replace('<li>', '<li class="page-item">', $pagination);
        $pagination = str_replace('<a', '<a class="page-link"', $pagination);

        return $pagination == '<ul class="pagination"></ul>' ? '' : $pagination;      

    }

    public static function defaultRelLinks($paginator, $keyword = null)
    {

        $relLinks = PaginateRoute::renderRelLinks($paginator, false);

        if (strpos($relLinks, 'app') == false)
        {

            if($keyword !== null)
            {
                $relLinks = str_replace('/page', '/'.$keyword.'/page', $relLinks);
                $relLinks = str_replace('/'.$keyword.'/'.$keyword, '/'.$keyword, $relLinks);
            }

        }     

        return $relLinks;

    }

    public static function defaultRelLinksNoReplacement($paginator)
    {

        return PaginateRoute::renderRelLinks($paginator, false);

    }

    public static function paginateRoutePagination($paginator)
    {

        $pagination = PaginateRoute::renderPageList($paginator, false, 'pagination', false);
        $pagination = str_replace('<li class="active">', '<li class="active page-item">', $pagination);
        $pagination = str_replace('<li>', '<li class="page-item">', $pagination);
        $pagination = str_replace('<a', '<a class="page-link"', $pagination);

        return $pagination == '<ul class="pagination"></ul>' ? '' : $pagination;

    }

}