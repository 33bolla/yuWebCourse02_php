<script>

class PostItem {
    constructor (title, body){
        //just for learning
        this.template="{{ content }}"; // defining a template for mustaches

    }  
    showPost(title, body){
        //test function
        console.log('from js clas PostItem:  ');
        console.log (title);
        console.log (body);
    }
}


class MustachePostItem{
    constructor ( title, body){
        
        this.template="{{ contenuto }}"; // defining a template for mustaches: using it only inside class 
        this.titleItem=title;
        this.bodyItem=body;
        this.postTitle; //Mustache rendering 
        this.postBody;
        this.outputTitleText; 
        this.outputBodyText;
    } 

    render(){
        //rendering post on postPage using Mustaches!
        
        //creating js objects  to work with mustache
        this.postTitle={contenuto:this.titleItem};//the same name in template label
        this.postBody={contenuto:this.bodyItem};
        

        //rendering variables with mustache
        this.outputTitleText = Mustache.render(this.template, this.postTitle); // this is the render html from mustache!
        this.outputBodyText = Mustache.render(this.template, this.postBody);
        
        
        //creating and filling new DOM elements
        this.titleOop=document.createElement("h1");
        this.bodyOop=document.createElement("p");

        this.titleOop.innerHTML=this.outputTitleText;
        this.bodyOop.innerHTML=this.outputBodyText;

        //rendering on document
        document.body.appendChild(this.titleOop); 
        document.body.appendChild(this.bodyOop); 
       
    }
    renderPosts(){
        //rendering all posts as links on home page using Mustaches!
        //creating js objects  to work with mustache
        this.postTitle={contenuto:this.titleItem};//the same name in template label
        this.postBody={contenuto:this.bodyItem};
    
        //rendering variables with mustache
        this.outputTitleText = Mustache.render(this.template, this.postTitle); // this is the render html from mustache!
        this.outputBodyText = Mustache.render(this.template, this.postBody);
        
        
        //creating  new DOM elements
        this.titleOop=document.createElement("h1");
        this.bodyOop=document.createElement("a");
        

        //defining qryString
        this.postPath="postPage.php";//or whatever you want passing as an argument
        this.qryStr="?selectedPostTitle="+this.titleItem;
        
        
        //editing bodyOop (now it's an "a" html tag/element)
        this.postPath=this.postPath+this.qryStr;
        this.bodyOop.setAttribute("href", this.postPath); 
    
        //filling new DOM elements
        this.titleOop.innerHTML=this.outputTitleText;
        this.bodyOop.innerHTML=this.outputBodyText;

        //rendering on document in a prefixed position (may be passed!!)
        document.getElementById("mainDiv").appendChild(this.titleOop); 
        document.getElementById("mainDiv").appendChild(this.bodyOop);
        // document.body.appendChild(this.titleOop); 
        // document.body.appendChild(this.bodyOop); 

    }
}



</script>