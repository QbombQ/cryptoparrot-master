<?php

namespace App\Model\Contracts\Interfaces\Validators\Common;

interface CommentValidatorInterface
{

    public function validateTradeComment($data);

    public function validateArticleComment($data);

    public function getErrors();

}