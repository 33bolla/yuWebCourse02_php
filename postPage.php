<?php 
//enable server session: storing and retrieving posts data (it's a demo)
session_start();
//post page showing singular post interely.
//with templates tag, mustache  an js manipulation
// page framework
include ('header.php');
include ('footer.php');

//accessing component blocks
include ('classes/jsClass.php');
include ('classes/phpClass.php');


//getting values from qry string (home page caller)

if (isset($_GET["selectedPostTitle"])) {
    $postTitle = $_GET["selectedPostTitle"];
    // echo "questo è il titolo selezionato da user: ".$postTitle."</br>";

} else {
    $errMsg = 'errore imprevisto contatta lo sviluppatore';
    echo $errMsg;
}

//showing values
if (isset($_SESSION["posts"]) ){
    $postBody=findingPostBody($postTitle);
    $_SESSION["currentPost"]["title"]=$postTitle;
    $_SESSION["currentPost"]["body"]=$postBody;
   
} else {
    $errMsg = 'errore imprevisto 2 contatta lo sviluppatore';
    echo $errMsg;
}




function findingPostBody($postTitle){
    //getting all posts on session
    // echo "this is the postTitle received from function caller  ".$postTitle."</br>";
    // var_dump ($_SESSION['posts']);
    $posts=$_SESSION['posts'];
    // var_dump ($posts);

    //finding selected post
    foreach ($posts as $post) {
        // echo "titolo del post  ".$post["title"]."</br>";
        // echo "this is the postTitle received from function caller  ".$postTitle."</br>";
        if ($post["title"]==$postTitle){
            // echo $post["title"];
            $postBody =$post["body"];
        //$post=array("title"=>$pTitle, "body"=>$pBody); //new entry in posts array
        }
    }
    return $postBody;
}
?>

<!-- not mandatory you are on the same page of the script
<template id="title">
     <h1>content for template 1</h1>
</template>

<template id="body">
     <p>content for template 2</p>
</template>
-->
<div class=container>
    <h1>you in postPage</h1>

    <!-- adding command buttons  with awesome icon-->
    <button type="button" class="btn btn-primary" onclick="location.href='compose.php'"><i class="fas fa-bookmark"></i>compose</button>
    <button type="button" class="btn btn-secondary" onclick="location.href='index.php'"><i class="fas fa-backward"></i>home</button>

</div>

<script>
    $(document).ready(function(){
    
    //getting selected (current) post
    var post={};
    post["title"]="<?php echo $_SESSION["currentPost"]["title"];?>";
    post["body"]="<?php echo $_SESSION["currentPost"]["body"];?>";
    console.log(post);    

    //rendering post content on page with oop+Mustache
    let myMustachePost1= new MustachePostItem('contenuto', post['title'], post['body']);
    let postRendered=myMustachePost1.render();

    
    //setting variables
    //settings
    var template = "{{ content }}"; // defining a template for mustaches
    var outputText="";
    var postContent={};
    var titleItem;
    var bodyItem;

    
    
   
    


    //creating js objects  to work with mustache
    var postTitle={content:post["title"]}; // 'content' key matching with template
    var postBody={content:post["body"]};
    
    console.log ('oggetti JS postTitle e postBody');
    console.log(postTitle);
    console.log(postBody);

    //rendering variables with mustache
    var outputTitleText = Mustache.render(template, postTitle); // this is the render html from mustache!
    var outputBodyText = Mustache.render(template, postBody);
    console.log('testing Mustache form script');
    console.log(outputTitleText);
    console.log(outputBodyText);
    
    //creating and filling new DOM elements
    titleItem = document.createElement("h1");   
    var bodyItem = document.createElement("p"); 
    
    titleItem.innerHTML = outputTitleText;   
    bodyItem.innerHTML = outputBodyText; 
    
    
    //positioning (appending)  elements on DOM
    document.body.appendChild(titleItem);  
    document.body.appendChild(bodyItem); 
    
    /* OOP WAY*/
    //testing classes building blocks
    let myPost= new PostItem();
    myPost.showPost(titleItem, bodyItem);

    //using Mustache on new DOM element
    // var titleOop=document.createElement("h1");
    // var bodyOop=document.createElement("p");

   
    // devo inviare le variabili non renderizzate da Mustache!!
    let myMustachePost= new MustachePostItem('contenuto', post['title'], post['body']);
    let postRendered1=myMustachePost.render();
    // let titleRendered=postRendered['title'];
    // let bodyRendered=postRendered['body'];
    // console.log('form caller:  '+titleRendered);
    // console.log('form caller2:  '+bodyRendered);
    
    // titleOop.innerHTML='ciao'+titleRendered;
    // bodyOop.innerHTML='bau'+bodyRendered;
    // document.body.appendChild(titleOop); 
    // document.body.appendChild(bodyOop); 


});

    




</script>