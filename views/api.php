

<html>

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title></title>
</head>

<body>
<form id="myForm" enctype="multipart/form-data">
  <input type="text" name="firstname" placeholder="Enter your name">
  <br>
  <input type="text" name="lastname" placeholder="Enter your name">
  <br>
  <input type="text" name="email" placeholder="Enter your name">
  <br>
  <input type="file" name="file" accept=".pdf, .doc, .docx">
  <br>
  <button type="submit">Submit</button>
</form>


  <script>
    document.getElementById('myForm').addEventListener('submit', async function (event) {
      event.preventDefault();
      const formData = new FormData(this);

      try {
        const res = await fetch('http://localhost:8080/include/candidate_form.php', {
          method: 'POST',
          body: formData
        });

        if (!res.ok) {
          throw Error("Couldn't submit the form");
        }

        const result = await res.json();
        alert("My name is " + result.fullname + " and my email address is " + result.email);

      } catch(e) {
        alert(e.message)
      };
    });
  </script>
</body>

</html>
