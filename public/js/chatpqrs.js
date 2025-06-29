document.addEventListener("DOMContentLoaded", function () {
  const chatBox = document.querySelector('.chatpqrs-mensajes');
  const input = document.querySelector('input[name="mensaje"]');
  const form = document.querySelector('.chatpqrs-input');
  if (!form || !chatBox || !input) return;

  // Extraer ID desde el action
  const actionUrl = form.getAttribute('action');
  const idPqrs = actionUrl.split('/').pop();

  function cargarMensajes() {
    fetch(`/greenloopv2/public/pqrschat/obtenerMensajes/${idPqrs}`)
      .then(res => res.json())
      .then(data => {
        chatBox.innerHTML = "";
        data.forEach(m => {
          const msg = document.createElement("div");
          msg.classList.add("chatpqrs-mensaje");
          msg.classList.add(m.tipo_emisor === 'usuario' ? 'chatpqrs-cliente' : 'chatpqrs-admin');
          msg.textContent = m.mensaje;
          chatBox.appendChild(msg);
        });
        chatBox.scrollTop = chatBox.scrollHeight;
      })
      .catch(err => console.error("❌ Error al cargar mensajes:", err));
  }

  form.addEventListener("submit", function (e) {
    e.preventDefault();
    const mensaje = input.value.trim();
    if (!mensaje) return;

    fetch(`/greenloopv2/public/pqrschat/enviarMensaje/${idPqrs}`, {
      method: "POST",
      headers: {
        'Content-Type': 'application/x-www-form-urlencoded'
      },
      body: `mensaje=${encodeURIComponent(mensaje)}`
    })
    .then(() => {
      input.value = "";
      cargarMensajes();
    })
    .catch(err => console.error("❌ Error al enviar mensaje:", err));
  });

  setInterval(cargarMensajes, 3000);
  cargarMensajes();
});
