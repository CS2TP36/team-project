document.querySelector('.close-btn').addEventListener('click', () => {
        document.querySelector('.application-form').classList.add('hidden'); 
    });

    document.getElementById('jobApplicationForm').addEventListener('submit', function(event) {
        event.preventDefault(); 

        
        const formData = new FormData(this);
        const jobId = formData.get('jobId');
        const name = formData.get('name');
        const email = formData.get('email');
        const resume = formData.get('resume');

        
        console.log('Job ID:', jobId);
        console.log('Name:', name);
        console.log('Email:', email);
        console.log('Resume:', resume.name);

        alert('Application submitted successfully!');
        this.reset(); 
        document.querySelector('.application-form').classList.add('hidden'); // 
    });
