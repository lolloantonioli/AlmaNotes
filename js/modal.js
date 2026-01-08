document.addEventListener('DOMContentLoaded', function () {
    var downloadModal = document.getElementById('downloadModal');
    
    if (downloadModal) {
        document.body.appendChild(downloadModal);

        downloadModal.addEventListener('show.bs.modal', function (event) {
            var button = event.relatedTarget;
            
            var fields = {
                '#modalFileName': 'data-file-name',
                '#modalProf': 'data-file-prof',
                '#modalCourse': 'data-file-course',
                '#modalSubject': 'data-file-subject',
                '#modalUser': 'data-file-user',
                '#modalDate': 'data-file-date',
                '#modalDownloads': 'data-file-downloads',
                '#modalAvg': 'data-file-reviews-avg',
                '#modalCount': 'data-file-reviews-count'
            };

            for (var selector in fields) {
                var element = downloadModal.querySelector(selector);
                if (element) {
                    element.textContent = button.getAttribute(fields[selector]);
                }
            }
            
            var confirmBtn = downloadModal.querySelector('#confirmDownloadBtn');
            if (confirmBtn) {
                confirmBtn.setAttribute('href', button.getAttribute('data-file-url'));
            }
        });
    }
});