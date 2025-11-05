  const voteCards = document.querySelectorAll('.vote-card');
  const toastEl = document.getElementById('voteToast');
  const toast = new bootstrap.Toast(toastEl, { delay: 3000 });
  const voteCounts = Array(voteCards.length).fill(0);
  const userVote = localStorage.getItem('userVote');

  // Cek apakah mode developer aktif
  const isDevMode =
    location.hostname === 'localhost' ||
    location.hostname === '127.0.0.1' ||
    location.search.includes('dev=true');

  // Jika developer mode, tampilkan tombol reset
  if (isDevMode) {
    document.getElementById('resetContainer').classList.remove('d-none');
  }

  // Jika user sudah pernah vote
  if (userVote) {
    const votedIndex = parseInt(userVote);
    const votedCard = voteCards[votedIndex];
    votedCard.classList.add('voted');
    const btn = votedCard.querySelector('.btn-vote');
    btn.innerText = "Voted ✓";

    voteCards.forEach((c, i) => {
      c.querySelector('.btn-vote').disabled = true;
      if (i !== votedIndex) c.querySelector('.btn-vote').innerText = "Vote";
    });
  }

  // Voting handler
  voteCards.forEach((card, index) => {
    const btn = card.querySelector('.btn-vote');
    const countDisplay = card.querySelector('.vote-count span');

    btn.addEventListener('click', (e) => {
      e.stopPropagation();

      // Cegah spam vote
      if (localStorage.getItem('userVote')) {
        toastEl.querySelector('.toast-body').innerText = "You have already voted. Thank you!";
        toast.show();
        return;
      }

      const designName = `Design ${index + 1}`;

      // Update tampilan
      card.classList.add('voted');
      btn.innerText = "Voted ✓";
      voteCards.forEach(c => c.querySelector('.btn-vote').disabled = true);

      // Tambah jumlah vote
      voteCounts[index]++;
      countDisplay.textContent = voteCounts[index];

      // Simpan ke localStorage
      localStorage.setItem('userVote', index);

      // Tampilkan toast
      toastEl.querySelector('.toast-body').innerText = `Thank you! You have voted for ${designName}.`;
      toast.show();
    });
  });

  // 🔁 Reset Vote (Hanya muncul di developer mode)
  const resetBtn = document.getElementById('resetVote');
  if (resetBtn) {
    resetBtn.addEventListener('click', () => {
      localStorage.removeItem('userVote');

      voteCards.forEach(card => {
        card.classList.remove('voted');
        const btn = card.querySelector('.btn-vote');
        btn.disabled = false;
        btn.innerText = "Vote";
      });

      toastEl.querySelector('.toast-body').innerText = "Vote has been reset (developer mode only).";
      toast.show();
    });
  }