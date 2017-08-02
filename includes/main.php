<?php
include_once('./config.php');
include_once('./constants.php');
include_once('views/view_helper.php');

include_once('controllers/main.controller.php');
require_once "includes/controllers/admin.controller.php";
include_once('models/mySQLi.model.php');
require_once "includes/models/admin.model.php";
 //assets
require_once "includes/assets/php/Paginator.class.php";

// CODE WRITER INCLUDES:



require_once "includes/controllers/todo.controller.php";
require_once "includes/models/todo.model.php";


require_once "includes/controllers/documents.controller.php";
require_once "includes/models/documents.model.php";
require_once "includes/controllers/record.controller.php";
require_once "includes/models/record.model.php";

require_once "includes/controllers/publish.controller.php";
require_once "includes/models/publish.model.php";
 

require_once "includes/controllers/notes.controller.php";
require_once "includes/models/notes.model.php";
require_once "includes/controllers/ux_emails.controller.php";
require_once "includes/models/ux_emails.model.php";
require_once "includes/controllers/snips.controller.php";
require_once "includes/models/snips.model.php";
require_once "includes/controllers/snapshot.controller.php";
require_once "includes/models/snapshot.model.php";
require_once "includes/controllers/prioritize.controller.php";
require_once "includes/models/prioritize.model.php";

  
require_once "includes/controllers/projects.controller.php";
require_once "includes/models/projects.model.php";
require_once "includes/controllers/requirements.controller.php";
require_once "includes/models/requirements.model.php";
require_once "includes/controllers/tasks.controller.php";
require_once "includes/models/tasks.model.php";
require_once "includes/controllers/webtickets.controller.php";
require_once "includes/models/webtickets.model.php";