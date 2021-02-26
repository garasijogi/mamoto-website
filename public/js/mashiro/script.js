var faq =  document.getElementsByClassName('collapsible');
var i;

for (let i = 0; i < faq.length; i++) {
    faq[i].addEventListener('click', function(){
        var active = this.classList.toggle('active');
        var content = this.nextElementSibling;
        var spinner = content.firstElementChild.firstElementChild;
        var text = content.lastElementChild;
        
        if (content.style.display === "block") {
            content.style.display = "none";
        } else {
            content.style.display = "block";
            spinner.style.display = "block";
            text.style.display = "none";

            setTimeout(() => {
                text.style.display = "block";
                spinner.style.display = "none";
            },1000);
        }

        var icon = this.firstChild;
        if (active) {
            icon.classList.remove('fa-plus');
            icon.classList.add('fas', 'fa-minus');
        } 
        else{
            icon.classList.remove('fa-minus');
            icon.classList.add('fas', 'fa-plus')
        }


        
    });
    
}

