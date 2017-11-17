<?php
function post_timeline($posts, $user_to_post_to) {
    $timeline = '<div id="timeline" class="row">
                  <div class="col-md-10 offset-1">
                    <form action="/public/user.php" method="POST" id="post-form">
                        <div class="form-group mx-auto">
                          <input class="form-control" name="user_id" type="hidden" value="' . $user_to_post_to['User_Id'] .'"/>
                          <input class="form-control" name="poster_id" type="hidden" value="' . current_user()['User_Id'] .'"/>
                          <input class="form-control" name="action" type="hidden" value="create_post"/>
                          <textarea name="text" class="form-control" name="Details" placeholder="What would you like to say?"></textarea>
                        </div>
                        <input class="btn btn-dark" type="submit" value="Post"/>
                    </form>
                    <div class="text-dark">';
                    
    if($posts) {
        foreach($posts as $post) {
            $timeline = $timeline . post_card($post);
        }
    }
        
    $timeline = $timeline . '</div>
                            </div>
                        </div>
                        <div class="card-footer text-muted text-center">
                            <a href="#" class="">Load More</a>
                        </div>';
    return $timeline;
}
?>