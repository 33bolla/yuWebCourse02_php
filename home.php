   
<?php
    //enable server session: storing posts data (it's a demo)
    session_start();
    
    //check for posts already stored (Please be careful about resubmitting with refreshing)
    if(!isset($_SESSION['posts'])){
   
        $_SESSION['posts']=[]; //no post stored; define posts as an empty array
    }
    //check if caller is compose page (post submit is set!!)
    if(isset($_POST["submit"])){
        
               
            //showing page framework
            include ('header.php');
            include ('footer.php');

            //get data from form
            $pTitle=$_POST["pTitle"];
            $pBody=$_POST["pBody"];
            
            //updating posts array
            $posts=$_SESSION['posts'];
            $post=array("title"=>$pTitle, "body"=>$pBody); //new entry in posts array
            array_push($posts, $post);
            
            //storing posts array
            //$_SESSION['posts'] = []; //reset (eliminates) all posts
            $_SESSION['posts'] = $posts; //store all post on $_session --works
            $postsLen=count($posts); 
            $_SESSION['postsLen']=$postsLen;

            //memo: big troubles with unsetting submit $POST element
    
    }


?>
<!-- this home welcome title is rendered 
with mustaches in main-js.php file-->
<h1>you in Home</h1>
<div id="myHomePanel"></div>

<!-- posts list  is rendered 
with mustaches in a for each loop in js section of this script
-->
<h1 id="postTitle"> </h1>
<p id="postBody"></p>

<script>
    $(document).ready(function(){
        //getting $posts elements from sessions
        <?php
            //check for posts already stored
            if(!isset($_SESSION['posts'])){
                $_SESSION['posts']=[]; //no post stored; define posts as an empty array
            }
            
            //getting $_SESSION['posts'] stored values
            $posts=$_SESSION['posts'];
            $postsLen=count($posts);
            //echo"test"; //doesn't work
        ?>


        //getting $posts length
        let postsLen="<?php echo $postsLen;?>";
        console.log(postsLen);
        
        //defining posts js associative array (or maybe object) 
        let posts=[];
        
        
        //console.log ('all the entries');
        //console.log ("there are " + postsLen+ "  post");
        
        //building posts array of JS Object
        <?php 
            foreach ($posts as $post) {
        ?> 
                //OCIO NONACCETTA RETURN NELLA TEXT AREA!!! 
                posts.push({'title':"<?php echo $post['title'];?>", 'body':"<?php echo $post['body'];?>"});
                
        <?php
                
            }
        ?>
        //da qui usare mustache per visualizzare i post su home!!
        console.log(posts);
        showPosts(posts);       
        console.log('ciao');
    });        
    
    function showPosts(posts){   
        //showing posts with mustaches and js dom manipulation        
        
        //settings
        var template = "{{ content }}"; // defining a template for mustaches
        var outputText="";
        var postContent={};
        var titleItem;
        var bodyItem;
        
        //posts in reverse order
        
        
        for (const post of posts) {
            console.log(post);
            
            /* using dom object model as in
            https://stackoverflow.com/questions/31057247/insert-html-code-in-javascript
            https://developer.mozilla.org/en-US/docs/Web/API/Document/createElement
            
            
            var postTitle={content:post["title"]}; // matching with template
            var postBody={content:post["body"]};
            var outputTitleText = Mustache.render(template, postTitle); // this is the render html from mustache!
            var outputBodyText = Mustache.render(template, postBody);
            
            //creating and filling new DOM elements
            titleItem = document.createElement("h1");   
            bodyItem = document.createElement("p"); 
            titleItem.innerHTML = outputTitleText;   
            bodyItem.innerHTML = outputBodyText;                 
            
            //positioning (appending) new elements on DOM
            document.body.appendChild(titleItem);  
            document.body.appendChild(bodyItem); 
                         
            // alternative: using jquery to fill elements
            // $("#postTitle").html(outputTitleText);
            // $("#postBody").html(outputBodyText);
        
        
        } 
    
        
        // var text = Mustache.render(template, homeStartingContent); 
        
    
    
    }


</script>





