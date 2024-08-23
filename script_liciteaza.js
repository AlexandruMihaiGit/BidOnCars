const pret_final = document.getElementById('pret');
const timp_final = document.getElementById('timp_ramas');
const buton_final = document.getElementById('buton_licitatie');

// incrementare pret automobil

buton_final.addEventListener('click',function()
{
    let continut = pret_final.textContent;

    let pret = continut.match(/\d+/)[0];
    if(pret <= 5000)
        pret = parseInt(pret) + parseInt(pret)*0.1;
    else if(pret <= 20000)
        pret = parseInt(pret) + parseInt(pret)*0.05;
    else
        pret = parseInt(pret) + parseInt(pret)*0.02;

    pret = Math.floor(pret);
    pret_final.textContent = 'Pret actual: ' + pret + '$';
});

// transformare timp in secunde 

function timp2secunde(tf){
    const [oreString , minuteString, secundeString] = tf.split(':');
    const ore = parseInt(oreString);
    const minute = parseInt(minuteString);
    const secunde = parseInt(secundeString);

    return (ore*3600) + (minute*60) + secunde;
}

// actualizare timp 
let t_final = 12*3600; // in 12 ore se incheie licitatia
let timp_total = timp2secunde(timp_final.textContent);

function actualizareCronometru(){
    const ore = Math.floor(timp_total/3600);
    const minute = Math.floor((timp_total % 3600)/60);
    const secunde = timp_total % 60;

    timp_final.textContent = `${ore < 10 ? '0' : ''}${ore}:${minute < 10 ? '0' : ''}${minute}:${secunde < 10 ? '0' : ''}${secunde}`;
}

// pornire cronometru
function startCronometru(){
    intervalID = setInterval(function(){
        timp_total--;
        actualizareCronometru();

        if (timp_total === 0){
            clearInterval(intervalID);
            buton_final.disabled = true;
        }
    },1000)
}

document.addEventListener('DOMContentLoaded',startCronometru());