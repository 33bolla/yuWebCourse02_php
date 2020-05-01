   
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


<!-- adding command buttons  with awesome icon-->
<button type="button" class="btn btn-primary" onclick="location.href='compose.php'"><i class="fas fa-bookmark"></i>compose</button>
<button type="button" class="btn btn-secondary" onclick="location.href='index.php'"><i class="fas fa-backward"></i>home</button>



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
        var posts=[];
        
        //console.log ('all the entries');
        //console.log ("there are " + postsLen+ "  post")      ,,;;..<<<>>>>>%@£=}]\\
        //building posts array of JS Object By me It's fine
        <?php
            foreach ($posts as $post) {
        ?> 
                //OCIO NON ACCETTA RETURN NELLA TEXT AREA!!! 
                posts.push({'title':"<?php echo $post['title'];?>", 'body':"<?php echo $post['body'];?>"});
                
        <?php
                
            }
        ?>
        //da qui usare mustache per visualizzare i post su home!!
        console.log(posts);//
        showPosts(posts);       
        console.log('ciao');
    });        
    
    function showPosts(posts){   
        //showing posts with mustaches and js dom manipulation        
        console.log('in show posts now!');
        //settings
        var template = "{{ content }}"; // defining a template for mustaches
        var outputText="";
        var postContent={};
        var titleItem;
        var bodyItem;
        
        //posts in reverse order
        posts.reverse();
        
        for (const post of posts) {
            console.log(post);
            
            /* using dom object model as in
            https://stackoverflow.com/questions/31057247/insert-html-code-in-javascript
            https://developer.mozilla.org/en-US/docs/Web/API/Document/createElement
            */
            //creating js obj to work with mustache
            var postTitle={content:post["title"]}; // 'content' key matching with template
            var postBody={content:post["body"]};
            
            //editing post['body'] in order to truncate and link last char to postPage processing
            var strLen=20;
            var postBodyStrTrunc = post["body"].substring(0,strLen);
            postBodyTrunc= {content:postBodyStrTrunc+"......"};

            
            //rendering variables with mustache
            var outputTitleText = Mustache.render(template, postTitle); // this is the render html from mustache!
            var outputBodyText = Mustache.render(template, postBody);
            var outputBodyTruncText = Mustache.render(template, postBodyTrunc);
            
            //creating and filling new DOM elements
            var titleItem = document.createElement("h1");   
            var bodyItem = document.createElement("p"); 
            var bodyTruncItem=document.createElement("a");
            titleItem.innerHTML = outputTitleText;   
            bodyItem.innerHTML = outputBodyText; 
            bodyTruncItem.innerHTML = outputBodyTruncText;                 
            
            //creating pathways on truncated elements
            var postPath="postPage.php";
            var qryStr="?selectedPostTitle="+post["title"];
            console.log (qryStr);
            
            postPath=postPath+qryStr;
            console.log(postPath);
            console.log(postTitle);
            bodyTruncItem.setAttribute("href", postPath); //setting attribute
            bodyTruncItem.innerHTML=outputBodyTruncText;
            
            
            //positioning (appending)  elements on DOM
            document.body.appendChild(titleItem);  
            document.body.appendChild(bodyItem); 
            document.body.appendChild(bodyTruncItem); 
                         
            // alternative: using jquery to fill elements
            // $("#postTitle").html(outputTitleText);
            // $("#postBody").html(outputBodyText);
        
            
            
            //creating pathways

            //open postPage when click on dots
        } 
    
        
        // var text = Mustache.render(template, homeStartingContent); 
    
    }


</script>





