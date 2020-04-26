   
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
            $_SESSION['posts'] = $posts; //store all post on $_session --works
            $postsLen=count($posts); 
            $_SESSION['postsLen']=$postsLen;

            //memo: big troubles with unsetting submit $POST element
    
    }


?>

<h1>you in Home</h1>
<div id="myHomePanel"></div>


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
                //console.log("<?php echo $post['title'];?>"); 
                posts.push({'title':"<?php echo $post['title'];?>",'body':"<?php echo $post['title'];?>"});
                //console.log(posts);
        <?php
                
            }
        ?>
        //da qui usare mustache per visualizzare i post su home!!
        console.log(posts);
        showPosts(posts);       
        console.log('ciao');
    });        
    function showPosts(posts){   
        //showing posts with mustaches         
        var template = "{{ content }}";
        var text="";
        var postContent={};
        for (const post of posts) {
            console.log(post);
            
            /* using dom object model as in
            https://stackoverflow.com/questions/31057247/insert-html-code-in-javascript
            i.e. you have to generate new nodes in document!
            quite different from ejs ...
            <h1 id="postTitle"> </h1>
            <p id="postBody"></p>
            */ 
            
            postTitle={content:post["title"]};
            text = Mustache.render(template, postTitle);
            $("#postTitle").html(text);
            $("#postBody").html('cipperimerlo');
        } 
    
        
        // var text = Mustache.render(template, homeStartingContent); 
        
    
    
    }


</script>





