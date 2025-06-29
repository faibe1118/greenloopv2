document.addEventListener("DOMContentLoaded", function () {
  const chatMensajes = document.querySelector('.chat-mensajes');
  const idNegociacion = chatMensajes?.dataset.negociacion;
  const idUsuario = chatMensajes?.dataset.usuario;

  let mensajesAnteriores = [];

  function cargarMensajes() {
    fetch(`/greenloopv2/public/chatNegociaciones/obtenerMensajes/${idNegociacion}`)
      .then(res => res.json())
      .then(mensajes => {
        if (JSON.stringify(mensajes) !== JSON.stringify(mensajesAnteriores)) {
          chatMensajes.innerHTML = '';

          mensajes.forEach(m => {
            const div = document.createElement('div');
            div.classList.add('mensaje');
            div.classList.add(m.id_emisor == idUsuario ? 'mensaje-cliente' : 'mensaje-vendedor');
            div.innerHTML = `${m.mensaje}<br><small>${m.fecha_envio}</small>`;
            chatMensajes.appendChild(div);
          });

          mensajesAnteriores = mensajes;
          chatMensajes.scrollTop = chatMensajes.scrollHeight;
        }
      })
      .catch(err => console.error('Error al cargar mensajes:', err));
  }

  if (chatMensajes) {
    cargarMensajes();
    setInterval(cargarMensajes, 5000);
  }
});
