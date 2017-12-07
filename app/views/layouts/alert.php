<?php
// EFFECTS: renders an alert onto the page if given in the session
// REQUIRES: "flash" must be set, "flash-type" determines the style, if not specified in session
//           defaults to primary
//           On pages with a form this function is called on each request which ends up deleting the
//           flash session variable, use AJAX for pages with form
function alert($use_ajax=false) {
    session_start();
    $class="success";
    $flash = @$_SESSION['flash'];
    $flash_type = @$_SESSION['flash-type'];
    $error_flash = @$_SESSION['error-flash'];
    $force_flash = @$_SESSION['force-flash'];
    $force_flash_type = @$_SESSION['force-flash-type'];
    
    if(!$use_ajax || isset($error_flash) || isset($force_flash)) {
        if(isset($force_flash)) {
            $class = $force_flash_type;
            $msg = $force_flash;
            unset($_SESSION['force-flash']);
            unset($_SESSION['force-flash-type']);
        }
        else if(isset($error_flash)) {
            $msg = $error_flash;
            $class = 'danger';
            unset($_SESSION['error-flash']);
        }
        else if(isset($flash)) {
            $msg = $flash;
            if(isset($flash_type)) { 
                $class = $flash_type;
                unset($_SESSION['flash-type']);
            }
            unset($_SESSION['flash']);
        } else {
            return '<div id="alert"></div>';
        }
        
        $close_js = '
            <script>
                var btn = document.getElementById("alert-close");
                btn.addEventListener("click", function(event) {
                    var trget = event.target.parentNode.parentNode;
                    trget.innerHTML = "";
                    trget.className = "";
                });
            </script>
        ';
        return '<div id="alert" class="mb-0 alert alert-' . $class . '">'
                    . $msg .'
                    <button type="button" id="alert-close" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                </div>' . $close_js;
    }
    // return an empty div with alert id so javascript can do ajax alerts
    return '<div id="alert"></div>';
}
?>