document.addEventListener('DOMContentLoaded', () => {
  const searchInput = document.getElementById('searchInput');
  const cards = document.querySelectorAll('.card.publi');

  if (!searchInput || cards.length === 0) return;

  searchInput.addEventListener('input', () => {
    const query = searchInput.value.toLowerCase().trim();
    let hayResultados = false;

    cards.forEach(card => {
      const keywords = card.dataset.keywords || '';
      const visible = keywords.includes(query);
      card.style.display = visible ? 'flex' : 'none';
      if (visible) hayResultados = true;
    });

    const msg = document.getElementById('noResultsMessage');
    if (!hayResultados) {
      if (!msg) {
        const newMsg = document.createElement('p');
        newMsg.id = 'noResultsMessage';
        newMsg.textContent = 'No hay resultados que coincidan con tu búsqueda.';
        newMsg.style.textAlign = 'center';
        newMsg.style.marginTop = '2rem';
        newMsg.style.color = '#fff';
        document.getElementById('cardsContainer').appendChild(newMsg);
      }
    } else {
      if (msg) msg.remove();
    }
  });
});
