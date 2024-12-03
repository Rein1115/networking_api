<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>

    <!-- Text fields for user details -->
    <label for="fname">First Name</label>
    <input type="text" name="fname" id="fname" value="" required>
    
    <label for="lname">Last Name</label>
    <input type="text" name="lname" id="lname" value="" required>
    
    <label for="contactno">Contact Number</label>
    <input type="text" name="contactno" id="contactno" value="" required>
    
    <label for="industry">Industry</label>
    <input type="text" name="industry" id="industry" value="">
    
    <label for="designation">Designation</label>
    <input type="text" name="designation" id="designation" value="">
    
    <label for="age">Age</label>
    <input type="number" name="age" id="age" value="">
    
    <label for="profession">Profession</label>
    <input type="text" name="profession" id="profession" value="">
    
    <!-- File upload fields -->
    <label for="profile_picture">Profile Picture (JPEG, PNG, JPG)</label>
    <input type="file" name="profile_picture" id="profile_picture" accept="image/jpeg, image/png, image/jpg">
    
    <label for="resumepdf">Resume PDF (PDF only)</label>
    <input type="file" name="resumepdf" id="resumepdf" accept="application/pdf">
    
    <!-- Submit button -->
    <button type="submit" id="submitBtn">Update Information</button>

    <!-- Display error message -->
    <div id="error-message" style="color: red; display: none;"></div>

    <!-- Success message -->
    <div id="success-message" style="color: green; display: none;"></div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script>
        $(document).ready(function () {


            $('#submitBtn').on('click', function (e) {
                var token = '1|EjqMtn3y0qa7K7KO8QuZAEDczZiqwKsoZDYKKiir96ff2aae';

                                // Create FormData object
                // var formData = new FormData();

                const formData = new FormData();
                formData.append('fname', this.fname);
                formData.append('lname', this.lname);
                formData.append('contactno', this.contactno);
                formData.append('mname', this.mname);
                formData.append('company', this.company);
                formData.append('age', this.age);
                formData.append('profession', this.profession);
                formData.append('profile_picture', this.profilePicture);  // Assuming file input for profile picture
                formData.append('resumepdf', this.resumePdf);  // Assuming file input for resume

axios.put('http://127.0.0.1:8001/api/profile/0' + formData, {
  headers: {
    'Content-Type': 'multipart/form-data',
    'Authorization': `Bearer ${token}`,
  }
})
.then(response => {
  console.log(response.data);
})
.catch(error => {
  console.error(error.response.data);
});


            });
        });
    </script>

</body>
</html>
