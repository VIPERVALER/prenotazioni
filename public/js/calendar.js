/*const temp = new Date();
let today = new Date(temp.getTime()-(temp.getDay()*(24*60*60*1000))+(24*60*60*1000));
let dates = new Array(18);

function setToday() {
    today = new Date(today.getTime()+(24*60*60*1000));
}

if (temp.getDay() == 6)
    today = new Date(today.getTime()+(6*(24*60*60*1000))+(24*60*60*1000));

for (let i=0; i<dates.length; i++) {
    let month = String(today.getMonth() + 1);
    let day = String(today.getDate());
    if (month.length==1)
        month="0"+month;
    if (day.length==1)
        day="0"+day;
    dates[i] = today.getFullYear() + "-" + month + "-" + day;
    setToday();
    if (i==5 || i==11)
        setToday();
}




let slideIndex = 1;

changeSlides(0);

function changeSlides(n) {

    let slides = document.getElementsByClassName('mySlides');
    slideIndex += n;

    if (slideIndex>1)
        document.getElementById('prev').classList.remove('disabled');
    else
        document.getElementById('prev').classList.add('disabled');

    if (slideIndex<3)
        document.getElementById('next').classList.remove('disabled');
    else
        document.getElementById('next').classList.add('disabled');

    for (let i = 0; i < slides.length; i++) {
        slides[i].style.display = "none";
    }

    slides[slideIndex-1].style.display = "block";
    slides[slideIndex+2].style.display = "block";
    slides[slideIndex+5].style.display = "block";
    slides[slideIndex+8].style.display = "block";
    slides[slideIndex+11].style.display = "block";
    slides[slideIndex+14].style.display = "block";
    slides[slideIndex+17].style.display = "block";
    slides[slideIndex+20].style.display = "block";
    slides[slideIndex+23].style.display = "block";
    slides[slideIndex+26].style.display = "block";
    slides[slideIndex+29].style.display = "block";
    slides[slideIndex+32].style.display = "block";
    slides[slideIndex+35].style.display = "block";
    slides[slideIndex+38].style.display = "block";
    slides[slideIndex+41].style.display = "block";
    slides[slideIndex+44].style.display = "block";
    slides[slideIndex+47].style.display = "block";
    slides[slideIndex+50].style.display = "block";
}






for (let i=0;i<4;i++) {
    today = new Date(temp.getTime()-(temp.getDay()*(24*60*60*1000))+(24*60*60*1000));
    if (temp.getDay()==6)
        today = new Date(today.getTime()+(6*(24*60*60*1000))+(24*60*60*1000));
    let date = document.getElementsByClassName('card-title');
    date[0].textContent = today.getDate() + "/" + (today.getMonth() + 1) + "/" + (today.getFullYear());
    setToday();
    date[3].textContent = today.getDate() + "/" + (today.getMonth() + 1) + "/" + (today.getFullYear());
    setToday();
    date[6].textContent = today.getDate() + "/" + (today.getMonth() + 1) + "/" + (today.getFullYear());
    setToday();
    date[9].textContent = today.getDate() + "/" + (today.getMonth() + 1) + "/" + (today.getFullYear());
    setToday();
    date[12].textContent = today.getDate() + "/" + (today.getMonth() + 1) + "/" + (today.getFullYear());
    setToday();
    date[15].textContent = today.getDate() + "/" + (today.getMonth() + 1) + "/" + (today.getFullYear());
    setToday();
    setToday();
    date[1].textContent = today.getDate() + "/" + (today.getMonth() + 1) + "/" + (today.getFullYear());
    setToday();
    date[4].textContent = today.getDate() + "/" + (today.getMonth() + 1) + "/" + (today.getFullYear());
    setToday();
    date[7].textContent = today.getDate() + "/" + (today.getMonth() + 1) + "/" + (today.getFullYear());
    setToday();
    date[10].textContent = today.getDate() + "/" + (today.getMonth() + 1) + "/" + (today.getFullYear());
    setToday();
    date[13].textContent = today.getDate() + "/" + (today.getMonth() + 1) + "/" + (today.getFullYear());
    setToday();
    date[16].textContent = today.getDate() + "/" + (today.getMonth() + 1) + "/" + (today.getFullYear());
    setToday();
    setToday();
    date[2].textContent = today.getDate() + "/" + (today.getMonth() + 1) + "/" + (today.getFullYear());
    setToday();
    date[5].textContent = today.getDate() + "/" + (today.getMonth() + 1) + "/" + (today.getFullYear());
    setToday();
    date[8].textContent = today.getDate() + "/" + (today.getMonth() + 1) + "/" + (today.getFullYear());
    setToday();
    date[11].textContent = today.getDate() + "/" + (today.getMonth() + 1) + "/" + (today.getFullYear());
    setToday();
    date[14].textContent = today.getDate() + "/" + (today.getMonth() + 1) + "/" + (today.getFullYear());
    setToday();
    date[17].textContent = today.getDate() + "/" + (today.getMonth() + 1) + "/" + (today.getFullYear());
}
*/