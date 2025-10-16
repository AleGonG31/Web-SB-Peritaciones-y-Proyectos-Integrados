window.history.scrollRestoration = "manual"; 

window.addEventListener("beforeunload", () => {
  window.scrollTo(0, 0);
});

window.addEventListener("load", () => {
  setTimeout(() => {
    window.scrollTo(0, 0);
  }, 0); 
});

document.querySelectorAll('input[type="tel"]').forEach(input => {
    input.addEventListener('input', () => {
        input.value = input.value.replace(/\D/g, '');
    });
});

const heroSection = document.getElementById("home");
const heroBgImg = new Image();
heroBgImg.src = "https://www.peritacionesdanielgarcia.com/wp-content/uploads/2016/08/peritaciones-en-vehiculos.jpg";
heroSection.style.opacity = 0;

heroBgImg.onload = () => {
    heroSection.style.transition = "opacity 0.5s ease-in";
    heroSection.style.opacity = 1;
};

const servicesSection = document.getElementById("services");
const servicesImg = new Image();
servicesImg.src = "https://estaticos.qdq.com/swdata/photos/039/039868718/ea455051434c4129b0313c70a25784a0.jpg";
servicesSection.style.opacity = 0;

servicesImg.onload = () => {
    servicesSection.style.transition = "opacity 0.5s ease-in";
    servicesSection.style.opacity = 1;
};

const heroTitle = document.querySelector(".hero h1");
const heroSubtitle = document.querySelector(".hero p");
const  heroBtn = document.querySelector(".hero .btn");

[heroTitle,  heroSubtitle, heroBtn].forEach((el, i) => {
    el.style.opacity = 0;
    el.style.transform = "translateY(-30px)";
    setTimeout(() => {
        el.style.transition = "all 0.8s ease-out";
        el.style.opacity = 1;
        el.style.transform = "translaeY(0)";
    }, 200 * i);
});

document.querySelectorAll('header nav a'). forEach(anchor => {
    anchor.addEventListener('click', function(e) {
        e.preventDefault();
        const targetId = this.getAttribute('href').substring(1);
        const targetSection = document.getElementById(targetId);
        targetSection.scrollIntoView({ behavior: 'smooth'});
    });
});

const cart = [];
const cartSummary = document.getElementById("cart-summary");
const addButtons = document.querySelectorAll(".add-to-cart");

addButtons.forEach(button => {
    button.addEventListener("click", () => {
        const card = button.closest(".service-card");
        const title = card.querySelector("h3").innerText;
        const priceText = card.querySelector(".price").innerText;
        const price = parseFloat(priceText.replace('€',''));

        cart.push({ title, price });
        updateCart();
    });
});

function updateCart() {
    if (cart.length === 0) {
        cartSummary.innerHTML = "No hay productos en el carrito";
    } else {
        cartSummary.innerHTML = "";
        let total = 0;

        cart.forEach((item, index) => {
            total += item.price;
            const div = document.createElement("div");
            div.innerHTML = `${item.title} - ${item.price.toFixed(2)}€ 
                <button class="remove-item" data-index="${index}">X</button>`;
            cartSummary.appendChild(div);
        });

        const clearBtn = document.createElement("button");
        clearBtn.innerText = "Vaciar carrito";
        clearBtn.classList.add("clear-cart-btn");
        clearBtn.style.marginTop = "0.8rem";
        clearBtn.style.padding = "0.5rem 1rem";
        clearBtn.style.backgroundColor = "#3b82f6";
        clearBtn.style.color = "white";
        clearBtn.style.border = "none";
        clearBtn.style.borderRadius = "10px";
        clearBtn.style.cursor = "pointer";
        clearBtn.style.transition = "background 0.3s";
        clearBtn.addEventListener("mouseover", () => clearBtn.style.backgroundColor = "#b91c1c");
        clearBtn.addEventListener("mouseout", () => clearBtn.style.backgroundColor = "#3b82f6");
        clearBtn.addEventListener("click", () => {
            cart.length = 0;
            updateCart();
        });
        cartSummary.appendChild(clearBtn);

        const totalDiv = document.createElement("div");
        totalDiv.style.fontWeight = "bold";
        totalDiv.style.marginTop = "0.5rem";
        totalDiv.innerText = `Total: ${total.toFixed(2)}€`;
        cartSummary.appendChild(totalDiv);

        document.querySelectorAll(".remove-item").forEach(btn => {
            btn.addEventListener("click", () => {
                const index = btn.getAttribute("data-index");
                cart.splice(index, 1);
                updateCart();
            });
        });
    }
}

window.addEventListener("load", () => {
    document.querySelectorAll("form").forEach(form => form.reset());
    cart.length = 0;
    updateCart();
});

const signupForm = document.getElementById("signup-form");
signupForm.addEventListener("submit", function(e) {
    e.preventDefault();

    const fullname = signupForm.fullname.value.trim();
    const email = signupForm.email.value.trim();
    const phone = signupForm.phone.value.trim();
    const password = signupForm.password.value.trim();
    let valid = true;
    let messages = [];

    if(fullname.length < 3){
        valid = false;
        messages.push("✖ El nombre debe tener al menos 3 caracteres.");
    }

    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if(!emailRegex.test(email)){
        valid = false;
        messages.push("✖ Introduce un correo electrónico válido.");
    }

    const phoneRegex = /^[0-9]{9}$/;
    if (!phoneRegex.test(phone)) {
        valid = false;
        messages.push("✖ Introduce un número de teléfono válido (9 dígitos).");
    }

    if(password.length < 6){
        valid = false;
        messages.push("✖ La contraseña debe tener al menos 6 caracteres.");
    }

    let feedback = signupForm.querySelector(".feedback");
    if(!feedback){
        feedback = document.createElement("div");
        feedback.className = "feedback";
        feedback.style.marginTop = "0.5rem";
        signupForm.appendChild(feedback);
    }

    if(valid){
        feedback.style.color = "green";
        feedback.innerText = "Te has registrado correctamente ✔.";
        signupForm.reset();
    } else {
        feedback.style.color = "red";
        feedback.innerText = messages.join(" ");
        feedback.innerText = messages.map(m => ` ${m}`).join("\n");
    }
});

const contactForm = document.getElementById("contact-form");
contactForm.addEventListener("submit", function(e){
    e.preventDefault();

    const name = contactForm.name.value.trim();
    const email = contactForm.email.value.trim();
    const phone = contactForm.phone.value.trim();
    const message = contactForm.message.value.trim();
    const reason = contactForm.reason.value;
    let valid = true;
    let messages = [];

    if(name.length < 3){
        valid = false;
        messages.push("✖ El nombre debe tener al menos 3 caracteres.");
    }

    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if(!emailRegex.test(email)){
        valid = false;
        messages.push("✖ Introduce un correo electrónico válido.");
    }

    const phoneRegex = /^[0-9]{9}$/;
    if (!phoneRegex.test(phone)) {
        valid = false;
        messages.push("✖ Introduce un número de teléfono válido (9 dígitos).");
    }

    if(reason === ""){
        valid = false;
        messages.push("✖ Selecciona un motivo de consulta.");
    }

    if(message.length < 5){
        valid = false;
        messages.push("✖ El mensaje debe tener al menos 5 caracteres.");
    }

    let feedback = contactForm.querySelector(".feedback");
    if(!feedback){
        feedback = document.createElement("div");
        feedback.className = "feedback";
        feedback.style.marginTop = "0.5rem";
        contactForm.appendChild(feedback);
    }

    if(valid){
        feedback.style.color = "green";
        feedback.innerText = "Formulario enviado con éxito, nos pondremos en contacto con usted lo antes posible ✔.";
        contactForm.reset();
    } else {
        feedback.style.color = "red";
        feedback.innerText = messages.join(" ");
        feedback.innerText = messages.map(m => ` ${m}`).join("\n");
    }
});