// Modern Brutalist Login Form JavaScript
class ModernBrutalistLoginForm {
  constructor() {
    this.form = document.querySelector(".form-signin");
    this.usernameInput = document.getElementById("username");
    this.passwordInput = document.getElementById("password");
    this.passwordToggle = document.getElementById("passwordToggle");
    this.submitButton = this.form.querySelector(".login-btn");
    this.successMessage = document.getElementById("successMessage");
    this.socialButtons = document.querySelectorAll(".social-btn");

    this.init();
  }

  init() {
    this.bindEvents();
    this.setupPasswordToggle();
    this.setupSocialButtons();
  }

  bindEvents() {
    this.form.addEventListener("submit", (e) => this.handleSubmit(e));
    this.usernameInput.addEventListener("blur", () => this.validateUsername());
    this.passwordInput.addEventListener("blur", () => this.validatePassword());
    this.usernameInput.addEventListener("input", () =>
      this.clearError("username")
    );
    this.passwordInput.addEventListener("input", () =>
      this.clearError("password")
    );
  }

  setupPasswordToggle() {
    this.passwordToggle.addEventListener("click", () => {
      const type = this.passwordInput.type === "password" ? "text" : "password";
      this.passwordInput.type = type;

      const toggleText = this.passwordToggle.querySelector(".toggle-text");
      toggleText.textContent = type === "password" ? "SHOW" : "HIDE";
    });
  }

  setupSocialButtons() {
    this.socialButtons.forEach((button) => {
      button.addEventListener("click", (e) => {
        const socialText = button.querySelector(".social-text").textContent;
        this.handleSocialLogin(socialText, button);
      });
    });
  }

  validateUsername() {
    const username = this.usernameInput.value.trim();

    if (!username) {
      this.showError("username", "Username is required");
      return false;
    }

    this.clearError("username");
    return true;
  }

  validatePassword() {
    const password = this.passwordInput.value;

    if (!password) {
      this.showError("password", "Password is required");
      return false;
    }

    if (password.length < 4) {
      this.showError("password", "Password must be at least 4 characters long");
      return false;
    }

    this.clearError("password");
    return true;
  }

  showError(field, message) {
    const input = document.getElementById(field);
    const formGroup = input ? input.closest(".form-group") : null;
    const errorElement = document.getElementById(`${field}Error`);

    if (formGroup) formGroup.classList.add("error");
    if (errorElement) {
      errorElement.textContent = message;
      errorElement.classList.add("show");
    }
  }

  clearError(field) {
    const input = document.getElementById(field);
    const formGroup = input ? input.closest(".form-group") : null;
    const errorElement = document.getElementById(`${field}Error`);

    if (formGroup) formGroup.classList.remove("error");
    if (errorElement) {
      errorElement.classList.remove("show");
      setTimeout(() => {
        errorElement.textContent = "";
      }, 300);
    }
  }

  async handleSubmit(e) {
    e.preventDefault();

    const isUsernameValid = this.validateUsername();
    const isPasswordValid = this.validatePassword();

    if (!isUsernameValid || !isPasswordValid) {
      return;
    }

    // Submit the form to process_login.php
    this.form.submit();
  }

  async handleSocialLogin(provider, button) {
    console.log(`Initiating ${provider} authentication...`);

    // Simple loading state
    button.style.pointerEvents = "none";
    button.style.opacity = "0.7";

    try {
      await new Promise((resolve) => setTimeout(resolve, 1500));
      console.log(`Redirecting to ${provider} authentication...`);
      // window.location.href = `/auth/${provider.toLowerCase()}`;
    } catch (error) {
      console.error(`${provider} authentication failed: ${error.message}`);
    } finally {
      button.style.pointerEvents = "auto";
      button.style.opacity = "1";
    }
  }

  setLoading(loading) {
    this.submitButton.classList.toggle("loading", loading);
    this.submitButton.disabled = loading;

    // Disable social buttons during loading
    this.socialButtons.forEach((button) => {
      button.style.pointerEvents = loading ? "none" : "auto";
      button.style.opacity = loading ? "0.6" : "1";
    });
  }

  showSuccess() {
    // Hide form with smooth transition
    this.form.style.transform = "scale(0.95)";
    this.form.style.opacity = "0";

    setTimeout(() => {
      this.form.style.display = "none";
      document.querySelector(".social-login").style.display = "none";
      document.querySelector(".signup-link").style.display = "none";

      // Show success message
      this.successMessage.classList.add("show");
    }, 300);

    // Redirect after success display
    setTimeout(() => {
      console.log("Redirecting to dashboard...");
      // window.location.href = '/dashboard';
    }, 3000);
  }
}

// Initialize the form when DOM is loaded
document.addEventListener("DOMContentLoaded", () => {
  new ModernBrutalistLoginForm();
});
