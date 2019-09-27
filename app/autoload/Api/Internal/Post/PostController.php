<?php

namespace App\Api\Internal\Post;

use App\Models\Post;
use App\Api\BaseController;

class PostController extends BaseController
{
    public function changeRating()
    {
        $res = $_POST['value'];
        $id = $_POST['id'];
        $action = $_POST['action'];

        if($action == "minus") {
            $new = $res - 1;
        } else {
            $new = $res + 1;
        }
        if($new > 0) {
            $result['value'] = "+" . (string)$new;
        } else {
            $result['value'] = $new;
        }
        $post = new Post($id);
        $post->update(['PROPERTY_RATING_VALUE' => $new]);

        return json_encode($result);
    }
}