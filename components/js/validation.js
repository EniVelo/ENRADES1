const validation = new JustValidate("#signup");

validation
  .addField("#name", [
    {
      rule: "required"
    }
  ])
  .addField("#email", [
    {
      rule: "required"
    },
    {
      rule: "email"
    },
    {
      validator: (value) => {
        return () => {
          return fetch("validate_email.php?email=" + encodeURIComponent(value))
            .then(function(response) {
              return response.json();
            })
            .then(function(json) {
              return json.avail; 
            });
        };
      },
      errorMessage: "Email already taken"
    }
  ])
  .addField("#password", [
    {
      rule: "required"
    },
    {
      rule: "password" 
    }
  ])
  .onSuccess((event) => {
    event.preventDefault();
    document.getElementById("signup").submit();
  });
