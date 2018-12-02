$(document).ready(function () {
  let error = ''

  document.cookie = "login="

  $('#register-event').click(function () {
    console.log('cos')
    showModal()
    $(document).mousedown(function (e) {
      const container = $('#modal-box')
      if (!container.is(e.target) && container.has(e.target).length === 0) {
        hideModal()
        clearModalInputs()
      }
    })
  })

  $('#forgotPassword').click(function () {
    showForgotPasswordModal()
    $(document).mousedown(function (e) {
      const container = $('#forgot-modal-box')
      if (!container.is(e.target) && container.has(e.target).length === 0) {
        hideForgotPasswordModal()
        clearForgotPasswordModalInputs()
      }
    })
  })

  $('.register-button-modal').click(function () {
    validateRegisterFields()
  })

  $('.cancel-button-modal').click(function () {
    hideModal()
    clearModalInputs()
  })

  function validateRegisterFields() {
    let password = $('#password-modal')
    let passwordRepeat = $('#password-modal-repeat')
    let email = $('#email-modal')
    let login = $('#login-modal')
    checkLogin(login)
    validatePassword(password)
    checkPasswords(password, passwordRepeat)
    validateEmail(email)
    if (error === '') {
      window.location = '../php/registerLogic.php'
      return true
    } else {
      alert(error)
      error = ''
      return false
    }
  }

  function validateEmail(email) {
    let re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/
    if (email.val() === '' || !re.test(email.val())) {
      error += 'Wprowadź poprawny adres email'
      return false
    }
    return true
  }

  function checkLogin(login) {
    if (login.val() === '') {
      error += 'Pole login jest puste\n'
      return false
    }
    return true
  }

  function validatePassword(fld) {
    const illegalChars = /[\W_]/
    if (fld.val() === '') {
      error += 'Pole hasło jest puste\n'
      return false
    } else if ((fld.val().length < 3) || (fld.val().length > 15)) {
      error += 'Hasło musi mieć długość pomiędzy 3 i 15\n'
      return false
    } else if (illegalChars.test(fld.val())) {
      error += 'Hasło zawiera niedozwolone znaki\n'
      return false
    } else if ((fld.val().search(/[a-zA-Z]+/) === -1) || (fld.val().search(/[0-9]+/) === -1)) {
      error += 'Hasło musi zawierać przynajmniej jedną liczbę oraz literę\n'
      return false
    }
    return true
  }

  function checkPasswords(password, passwordRepeat) {
    if (password.val() === passwordRepeat.val()) {
      return true
    } else {
      error += 'Hasła nie są takie same\n'
      return false
    }
  }

  function clearModalInputs() {
    $('#password-modal').val('')
    $('#password-modal-repeat').val('')
    $('#email-modal').val('')
  }

  function hideModal() {
    $('#id01').hide()
  }

  function showModal() {
    $('#id01').show()
  }

  function showForgotPasswordModal() {
    $('#forgotPasswordModal').show()
  }

  function hideForgotPasswordModal() {
    $('#forgotPasswordModal').hide()
  }

  function clearForgotPasswordModalInputs() {
    $('#forgot-password-modal').val('')
    $('#forgot-password-modal-repeat').val('')
    $('#forgot-email-modal').val('')
  }
})