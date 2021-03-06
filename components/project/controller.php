<?php

    /*
    *  Copyright (c) Codiad & Kent Safranski (codiad.com), distributed
    *  as-is and without warranty under the MIT License. See 
    *  [root]/license.txt for more. This information must remain intact.
    */


    require_once('../../config.php');
    require_once('class.project.php');
    
    //////////////////////////////////////////////////////////////////
    // Verify Session or Key
    //////////////////////////////////////////////////////////////////
    
    checkSession();
    
    $Project = new Project();

    //////////////////////////////////////////////////////////////////
    // Get Current Project
    //////////////////////////////////////////////////////////////////
    
    $no_return = false;
    if(isset($_GET['no_return'])){ $no_return = true; }
    
    if($_GET['action']=='get_current'){
        if(!isset($_SESSION['project'])){
            // Load default/first project
            if($no_return){ $this->no_return = true; }
            $Project->GetFirst();
        }else{
            // Load current
            $Project->path = $_SESSION['project'];
            $project_name = $Project->GetName();
            if(!$no_return){ echo formatJSEND("success",array("name"=>$project_name,"path"=>$_SESSION['project'])); }
        }
    }
    
    //////////////////////////////////////////////////////////////////
    // Open Project
    //////////////////////////////////////////////////////////////////
    
    if($_GET['action']=='open'){
        $Project->path = $_GET['path'];
        $Project->Open();
    }
    
    //////////////////////////////////////////////////////////////////
    // Create Project
    //////////////////////////////////////////////////////////////////
    
    if($_GET['action']=='create'){
        $Project->name = $_GET['project_name'];
        $Project->Create();
    }
    
    //////////////////////////////////////////////////////////////////
    // Delete Project
    //////////////////////////////////////////////////////////////////
    
    if($_GET['action']=='delete'){
        $Project->path = $_GET['project_path'];
        $Project->Delete();
    }

?>