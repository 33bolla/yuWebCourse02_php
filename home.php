   
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
            include ('classes/jsClass.php');

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

<div class= 'container' id="mainDiv">
    <h1>you in Home</h1>
    <div id="myHomePanel"></div>
    
    <!-- adding command buttons  with awesome icon-->
    <button type="button" class="btn btn-primary" onclick="location.href='compose.php'"><i class="fas fa-bookmark"></i>compose</button>
    <button type="button" class="btn btn-info" onclick="location.href='index.php'"><i class="fas fa-backward"></i>home</button>
    
    <!-- posts list  is rendered 
    with mustaches in a for each loop in js section of this script
    -->
    <h1 id="postTitle"> </h1>
    <p id="postBody"></p>

</div>

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
        //posts in reverse order
        posts.reverse();
        console.log('in oop area ');
        for (const post of posts) {


            //editing post['body] in order to obtain a truncate string of fixed length
            let strLen1=20;
            let post_body=post["body"].substring(0,strLen1);
            post_body=post_body+".........";
            
            //rendering on home page
            let myMustachePost= new MustachePostItem(post['title'], post_body);
            let postRendered=myMustachePost.renderPosts();
        }
    }
</script>





