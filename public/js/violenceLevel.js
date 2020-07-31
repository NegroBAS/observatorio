const storage = window.localStorage;
var level = document.getElementById("level");
var violentometro = document.getElementById("nivel-violentometro");
var sum = 0.0;


let checks = [];

var index = 0;
var attention_route = document.getElementsByName("message");
var action_to_take = document.getElementsByName("action_to_take");
last = attention_route.length;

function resetItems() {
    // localStorage.clear();
    for (let i = 0; i < localStorage.length; i++) {
        console.log(localStorage.key(i));
        checks.push(document.getElementById(localStorage.key(i)));
    }
    checks.forEach(check => {
        if (storage.getItem(check.id) != null) {
            if (storage.getItem(check.id) === "true") {
                sum += parseFloat(check.dataset.value);
                console.log("¿Necesitas hablar con alguien?");
                check.setAttribute("checked", false);
            }
        }
    });

}

function putMessage(i) {
    document.getElementById("toast-message").style.display = "block";
    document.getElementById("toast").innerHTML = "";
    document.getElementById("toast").innerHTML = attention_route[i].value;
    document.getElementById("action-to-take").innerHTML = "";
    document.getElementById("action-to-take").innerHTML = action_to_take[i].value;
    // console.log(action_to_take[i].value);
    // console.log(attention_route[i].value);

    $(document).ready(function () {
        time = 100000;
        $(".toast").toast("show");
        setTimeout(function () {
            document.getElementById("toast-message").style.display = "none";
        }, time);
        time = 0;
    });
}

function onChange(e) {
    storage.setItem(e.id, e.checked);
    if (e.checked) {
        sum += parseFloat(parseFloat(e.dataset.value).toFixed(1));
    } else {
        if (sum > 1) {
            sum -= parseFloat(parseFloat(e.dataset.value).toFixed(1));
        } else {
            sum = 0;
        }
    }

    index = e.id.substr(-2);
    index = index - 1;
    putMessage(index);
    console.log(index);
    console.log(parseFloat(sum).toFixed(1));

    if (
        navigator.userAgent.match(/Android/i) ||
        navigator.userAgent.match(/webOS/i) ||
        navigator.userAgent.match(/iPhone/i) ||
        navigator.userAgent.match(/iPad/i) ||
        navigator.userAgent.match(/iPod/i) ||
        navigator.userAgent.match(/BlackBerry/i) ||
        navigator.userAgent.match(/Windows Phone/i)
    ) {
        // console.log("movil");
        storage.setItem(
            "level",
            (document.getElementById("level").style.width = 100 - sum + "%")
        );
        document.getElementById("level").style.width = storage.getItem("level");
        document.getElementById("level").style.height = "100%";
    } else {
        // console.log("mas grande")

        storage.setItem(
            "level",
            (document.getElementById("level").style.height = 100 - sum + "%")
        );
        document.getElementById("level").style.height = storage.getItem(
            "level"
        );
        storage.setItem("level", (level.style.height = 100 - sum + "%"));
    }

    // console.log(parseFloat(sum).toFixed(1));

    if (sum > 99) {
        level.style.display = "none";
    } else {
        level.style.display = "block";
    }
    // level.style.height = storage.getItem("level");

    if (sum < 33.3) {
        violentometro.style.backgroundColor = "#ffd531";
    } else if (sum > 33.3 && sum < 66.6) {
        violentometro.style.backgroundColor = "#fc7a56";
    } else if (sum > 66.6) {
        violentometro.style.backgroundColor = "#f1608e";
    } else if (sum == 1.2) {
        violentometro.style.backgroundColor = "darkgray";
    }
}

$(document).ready(function () {
    for (let i = 0; i < localStorage.length; i++) {
        // console.log(localStorage.key(i));
        checks.push(document.getElementById(localStorage.key(i)));
    }
    if (
        navigator.userAgent.match(/Android/i) ||
        navigator.userAgent.match(/webOS/i) ||
        navigator.userAgent.match(/iPhone/i) ||
        navigator.userAgent.match(/iPad/i) ||
        navigator.userAgent.match(/iPod/i) ||
        navigator.userAgent.match(/BlackBerry/i) ||
        navigator.userAgent.match(/Windows Phone/i)
    ) {
        level.style.width = storage.getItem("level");
    } else {
        level.style.height = storage.getItem("level");
    }

    if (sum > 99) {
        level.style.display = "none";
    } else {
        level.style.display = "block";
    }
    // level.style.height = storage.getItem("level");

    if (sum < 33.3) {
        violentometro.style.backgroundColor = "#ffd531";
    } else if (sum > 33.3 && sum < 66.6) {
        violentometro.style.backgroundColor = "#fc7a56";
    } else if (sum > 66.6) {
        violentometro.style.backgroundColor = "#f1608e";
    } else if (sum == 1.2) {
        violentometro.style.backgroundColor = "darkgray";
    }
    checks.forEach(check => {
        if (storage.getItem(check.id) != null) {
            if (storage.getItem(check.id) === "true") {
                sum += parseFloat(check.dataset.value);
                // console.log("¿Necesitas hablar con alguien?");
                check.setAttribute("checked", true);
            }
        }
    });

    // console.log(parseFloat(sum).toFixed(1));
});
