document.addEventListener('DOMContentLoaded', function() {
    const reviewModal = document.getElementById('reviewModal');
    let selectedStars = 0;
    let currentAppunti = 0;
    
    if (reviewModal) {
        reviewModal.addEventListener('show.bs.modal', function (event) {
            const button = event.relatedTarget;
            document.getElementById('modalFileName').textContent = button.getAttribute('data-file-name');
            document.getElementById('modalProf').textContent = 'Prof. ' + button.getAttribute('data-file-prof');
            document.getElementById('modalCourse').textContent = button.getAttribute('data-file-course');
            currentAppunti = button.getAttribute('data-file-codice');
            selectedStars = 0;
            
            const starBtns = document.querySelectorAll('.star-btn');
            starBtns.forEach(btn => {
                btn.classList.remove('selected');
            });
            document.getElementById('ratingText').textContent = 'Seleziona una valutazione';
            document.getElementById('submitReviewBtn').disabled = true;
        });
        
        reviewModal.addEventListener('click', function(e) {
            if (e.target.classList.contains('star-btn')) {
                selectedStars = parseInt(e.target.getAttribute('data-star'));
                updateStars();
            }
        });
        
        document.getElementById('submitReviewBtn').addEventListener('click', function () {
            if (selectedStars === 0 || currentAppunti === 0) return;
            
            const formData = new FormData();
            formData.append('appunti_codice', currentAppunti);
            formData.append('stelle', selectedStars);
            
            console.log('Invio recensione:', {codice: currentAppunti, stelle: selectedStars});
            
            fetch('add-review.php', {
                method: 'POST',
                body: formData
            })
            .then(response => {
                console.log('Response status:', response.status);
                return response.text();
            })
            .then(data => {
                console.log('Response data:', data);
                try {
                    const jsonData = JSON.parse(data);
                    console.log('Parsed JSON:', jsonData);
                    
                    const modal = bootstrap.Modal.getInstance(reviewModal);
                    modal.hide();
                    
                    setTimeout(() => {
                        window.location.reload();
                    }, 300);
                } catch(e) {
                    console.error('JSON parse error:', e);
                    console.error('Raw response was:', data);
                }
            })
            .catch(error => {
                console.error('Fetch error:', error);
                const modal = bootstrap.Modal.getInstance(reviewModal);
                modal.hide();
                window.location.reload();
            });
        });
    }
    
    function updateStars() {
        const starBtns = document.querySelectorAll('.star-btn');
        starBtns.forEach((btn, index) => {
            if (index + 1 <= selectedStars) {
                btn.classList.add('selected');
            } else {
                btn.classList.remove('selected');
            }
        });
        
        const ratingTexts = ['', 'Pessimo', 'Scarso', 'Buono', 'Molto Buono', 'Eccellente'];
        document.getElementById('ratingText').textContent = selectedStars > 0 ? ratingTexts[selectedStars] + ' (' + selectedStars + '/5)' : 'Seleziona una valutazione';
        
        document.getElementById('submitReviewBtn').disabled = selectedStars === 0;
    }
});
