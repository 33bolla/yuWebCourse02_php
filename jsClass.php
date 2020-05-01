<script>

class PostItem {
    constructor (title, body){
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
    constructor (contenuto, title, body){
        this.template="{{ "+contenuto+" }}"; // defining a template for mustaches
        this.postContent={};
        this.titleItem=title;
        this.bodyItem=body;
        this.postTitle;
        this.postBody;
        this.outputTitleText; //post Mustache rendering 
        this.outputBodyText;


    } 

    render(){
        //rendering post on postPage using Mustaches!
        
        
        console.log('in Mustache render class now');
        console.log(this.template);
        console.log(this.titleItem);
        console.log(this.bodyItem);

        //creating js objects  to work with mustache
        // this.postTitle={contenuto:this.titleItem}; // 'content' key matching with template
        // this.postBody={contenuto:this.bodyItem};
        this.postTitle={contenuto:this.titleItem};
        this.postBody={contenuto:this.bodyItem};

        console.log('testing Mustache from Classes');
        console.log(this.postTitle);
        console.log(this.postBody);
        

        //rendering variables with mustache
        this.outputTitleText = Mustache.render(this.template, this.postTitle); // this is the render html from mustache!
        this.outputBodyText = Mustache.render(this.template, this.postBody);
        console.log(this.outputTitleText);
        console.log(this.outputBodyText);
        
        //creating and filling new DOM elements
        this.titleOop=document.createElement("h1");
        this.bodyOop=document.createElement("p");

        this.titleOop.innerHTML='ciao'+this.outputTitleText;
        this.bodyOop.innerHTML='bau'+this.outputBodyText;

        document.body.appendChild(this.titleOop); 
        document.body.appendChild(this.bodyOop); 
        
        // this.postContent['title']=this.outputTitleText;
        // this.postContent['body']=this.outputBodyText;
        // return this.postContent;

    }

}



</script>