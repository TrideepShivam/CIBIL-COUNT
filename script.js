export default function Ajax(method='POST',url=null){
    const xhr = new XMLHttpRequest();
    xhr.open(method,url);
    xhr.onload = ()=>{
        notify({
            status:'',
            content:xhr.responseText
        });
    }
    xhr.send();
}

function getNewPage(t){
    let btn=t.name;
    let target=btn+".php";
    window.location.href=target;
}
//status used to check success,failure
//message will be the content of the notification
function notify(data={}){
    let container = document.createElement('div');
    container.setAttribute('class','notificationContainer');
    container.style.cssText=`
    background:white;
        width:300px;
        padding:10px;
        position:absolute;
        top:10px;
        right:10px;
        border-radius:5px;
        display:flex;
        align-items:center;
        gap:5px;
        animation:fadeIn 1s;
    `;
    let img = document.createElement('img');
    img.style.cssText = "width:50px;";
    let imgLoc = data.status?'success.gif':'error.gif';
    img.src='./picture/'+imgLoc;
    img.alt="i";
    container.appendChild(img);

    let msg = document.createElement('p');
    msg.appendChild(document.createTextNode(data.content));
    container.appendChild(msg);
    document.body.appendChild(container);

    setTimeout(() => {
        container.remove();
    }, 5000);
}

const loginForm = document.getElementById('login');
const registerForm = document.getElementById('register');
loginForm.addEventListener('submit',(e)=>{
    e.preventDefault();
    let url = "./operations/login.php?";
    let formData = new FormData(loginForm);
    formData.forEach((value,key)=>{
        url+=key+'='+value+'&';
    })
    Ajax('POST',url.substring(0,url.length-1));
});

