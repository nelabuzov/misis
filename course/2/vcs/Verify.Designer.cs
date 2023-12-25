namespace vcs
{
    partial class Verify
    {
        /// <summary>
        /// Обязательная переменная конструктора.
        /// </summary>
        private System.ComponentModel.IContainer components = null;

        /// <summary>
        /// Освободить все используемые ресурсы.
        /// </summary>
        /// <param name="disposing">истинно, если управляемый ресурс должен быть удален; иначе ложно.</param>
        protected override void Dispose(bool disposing)
        {
            if (disposing && (components != null))
            {
                components.Dispose();
            }
            base.Dispose(disposing);
        }

        #region Код, автоматически созданный конструктором форм Windows

        /// <summary>
        /// Требуемый метод для поддержки конструктора — не изменяйте 
        /// содержимое этого метода с помощью редактора кода.
        /// </summary>
        private void InitializeComponent()
        {
            System.ComponentModel.ComponentResourceManager resources = new System.ComponentModel.ComponentResourceManager(typeof(Verify));
            this.signupButton = new MaterialSkin.Controls.MaterialButton();
            this.signinButton = new MaterialSkin.Controls.MaterialButton();
            this.materialLabel1 = new MaterialSkin.Controls.MaterialLabel();
            this.login = new MaterialSkin.Controls.MaterialTextBox();
            this.materialLabel2 = new MaterialSkin.Controls.MaterialLabel();
            this.materialLabel3 = new MaterialSkin.Controls.MaterialLabel();
            this.password = new MaterialSkin.Controls.MaterialTextBox();
            this.passwordRepeat = new MaterialSkin.Controls.MaterialTextBox();
            this.SuspendLayout();
            // 
            // signupButton
            // 
            this.signupButton.AutoSizeMode = System.Windows.Forms.AutoSizeMode.GrowAndShrink;
            this.signupButton.Density = MaterialSkin.Controls.MaterialButton.MaterialButtonDensity.Default;
            this.signupButton.Depth = 0;
            this.signupButton.HighEmphasis = true;
            this.signupButton.Icon = null;
            this.signupButton.Location = new System.Drawing.Point(21, 410);
            this.signupButton.Margin = new System.Windows.Forms.Padding(4, 6, 4, 6);
            this.signupButton.MouseState = MaterialSkin.MouseState.HOVER;
            this.signupButton.Name = "signupButton";
            this.signupButton.NoAccentTextColor = System.Drawing.Color.Empty;
            this.signupButton.Size = new System.Drawing.Size(126, 36);
            this.signupButton.TabIndex = 4;
            this.signupButton.Text = "Регистрация";
            this.signupButton.Type = MaterialSkin.Controls.MaterialButton.MaterialButtonType.Contained;
            this.signupButton.UseAccentColor = false;
            this.signupButton.UseVisualStyleBackColor = true;
            this.signupButton.Click += new System.EventHandler(this.signupButton_Click);
            // 
            // signinButton
            // 
            this.signinButton.AutoSizeMode = System.Windows.Forms.AutoSizeMode.GrowAndShrink;
            this.signinButton.Density = MaterialSkin.Controls.MaterialButton.MaterialButtonDensity.Default;
            this.signinButton.Depth = 0;
            this.signinButton.HighEmphasis = true;
            this.signinButton.Icon = null;
            this.signinButton.Location = new System.Drawing.Point(155, 410);
            this.signinButton.Margin = new System.Windows.Forms.Padding(4, 6, 4, 6);
            this.signinButton.MouseState = MaterialSkin.MouseState.HOVER;
            this.signinButton.Name = "signinButton";
            this.signinButton.NoAccentTextColor = System.Drawing.Color.Empty;
            this.signinButton.Size = new System.Drawing.Size(129, 36);
            this.signinButton.TabIndex = 5;
            this.signinButton.Text = "Авторизация";
            this.signinButton.Type = MaterialSkin.Controls.MaterialButton.MaterialButtonType.Contained;
            this.signinButton.UseAccentColor = false;
            this.signinButton.UseVisualStyleBackColor = true;
            this.signinButton.Click += new System.EventHandler(this.signinButton_Click);
            // 
            // materialLabel1
            // 
            this.materialLabel1.AutoSize = true;
            this.materialLabel1.Depth = 0;
            this.materialLabel1.Font = new System.Drawing.Font("Roboto", 14F, System.Drawing.FontStyle.Regular, System.Drawing.GraphicsUnit.Pixel);
            this.materialLabel1.Location = new System.Drawing.Point(18, 84);
            this.materialLabel1.MouseState = MaterialSkin.MouseState.HOVER;
            this.materialLabel1.Name = "materialLabel1";
            this.materialLabel1.Size = new System.Drawing.Size(110, 19);
            this.materialLabel1.TabIndex = 26;
            this.materialLabel1.Text = "Введите логин";
            // 
            // login
            // 
            this.login.AnimateReadOnly = false;
            this.login.BorderStyle = System.Windows.Forms.BorderStyle.None;
            this.login.Depth = 0;
            this.login.Font = new System.Drawing.Font("Roboto", 16F, System.Drawing.FontStyle.Regular, System.Drawing.GraphicsUnit.Pixel);
            this.login.LeadingIcon = null;
            this.login.Location = new System.Drawing.Point(21, 106);
            this.login.MaxLength = 50;
            this.login.MouseState = MaterialSkin.MouseState.OUT;
            this.login.Multiline = false;
            this.login.Name = "login";
            this.login.Size = new System.Drawing.Size(263, 50);
            this.login.TabIndex = 1;
            this.login.Text = "";
            this.login.TrailingIcon = null;
            // 
            // materialLabel2
            // 
            this.materialLabel2.AutoSize = true;
            this.materialLabel2.Depth = 0;
            this.materialLabel2.Font = new System.Drawing.Font("Roboto", 14F, System.Drawing.FontStyle.Regular, System.Drawing.GraphicsUnit.Pixel);
            this.materialLabel2.Location = new System.Drawing.Point(18, 177);
            this.materialLabel2.MouseState = MaterialSkin.MouseState.HOVER;
            this.materialLabel2.Name = "materialLabel2";
            this.materialLabel2.Size = new System.Drawing.Size(121, 19);
            this.materialLabel2.TabIndex = 28;
            this.materialLabel2.Text = "Введите пароль";
            // 
            // materialLabel3
            // 
            this.materialLabel3.AutoSize = true;
            this.materialLabel3.Depth = 0;
            this.materialLabel3.Font = new System.Drawing.Font("Roboto", 14F, System.Drawing.FontStyle.Regular, System.Drawing.GraphicsUnit.Pixel);
            this.materialLabel3.Location = new System.Drawing.Point(18, 277);
            this.materialLabel3.MouseState = MaterialSkin.MouseState.HOVER;
            this.materialLabel3.Name = "materialLabel3";
            this.materialLabel3.Size = new System.Drawing.Size(144, 19);
            this.materialLabel3.TabIndex = 29;
            this.materialLabel3.Text = "Повторный пароль";
            // 
            // password
            // 
            this.password.AnimateReadOnly = false;
            this.password.BorderStyle = System.Windows.Forms.BorderStyle.None;
            this.password.Depth = 0;
            this.password.Font = new System.Drawing.Font("Roboto", 16F, System.Drawing.FontStyle.Regular, System.Drawing.GraphicsUnit.Pixel);
            this.password.LeadingIcon = null;
            this.password.Location = new System.Drawing.Point(21, 199);
            this.password.MaxLength = 50;
            this.password.MouseState = MaterialSkin.MouseState.OUT;
            this.password.Multiline = false;
            this.password.Name = "password";
            this.password.Password = true;
            this.password.Size = new System.Drawing.Size(263, 50);
            this.password.TabIndex = 2;
            this.password.Text = "";
            this.password.TrailingIcon = null;
            // 
            // passwordRepeat
            // 
            this.passwordRepeat.AnimateReadOnly = false;
            this.passwordRepeat.BorderStyle = System.Windows.Forms.BorderStyle.None;
            this.passwordRepeat.Depth = 0;
            this.passwordRepeat.Font = new System.Drawing.Font("Roboto", 16F, System.Drawing.FontStyle.Regular, System.Drawing.GraphicsUnit.Pixel);
            this.passwordRepeat.LeadingIcon = null;
            this.passwordRepeat.LeaveOnEnterKey = true;
            this.passwordRepeat.Location = new System.Drawing.Point(21, 299);
            this.passwordRepeat.MaxLength = 50;
            this.passwordRepeat.MouseState = MaterialSkin.MouseState.OUT;
            this.passwordRepeat.Multiline = false;
            this.passwordRepeat.Name = "passwordRepeat";
            this.passwordRepeat.Password = true;
            this.passwordRepeat.Size = new System.Drawing.Size(263, 50);
            this.passwordRepeat.TabIndex = 3;
            this.passwordRepeat.Text = "";
            this.passwordRepeat.TrailingIcon = null;
            // 
            // Verify
            // 
            this.AutoScaleDimensions = new System.Drawing.SizeF(6F, 13F);
            this.AutoScaleMode = System.Windows.Forms.AutoScaleMode.Font;
            this.ClientSize = new System.Drawing.Size(305, 480);
            this.Controls.Add(this.passwordRepeat);
            this.Controls.Add(this.password);
            this.Controls.Add(this.materialLabel3);
            this.Controls.Add(this.materialLabel2);
            this.Controls.Add(this.login);
            this.Controls.Add(this.materialLabel1);
            this.Controls.Add(this.signinButton);
            this.Controls.Add(this.signupButton);
            this.FormBorderStyle = System.Windows.Forms.FormBorderStyle.FixedToolWindow;
            this.Icon = ((System.Drawing.Icon)(resources.GetObject("$this.Icon")));
            this.Name = "Verify";
            this.StartPosition = System.Windows.Forms.FormStartPosition.CenterScreen;
            this.Text = "Верификация";
            this.FormClosing += new System.Windows.Forms.FormClosingEventHandler(this.Verify_FormClosing);
            this.Load += new System.EventHandler(this.User_Load);
            this.ResumeLayout(false);
            this.PerformLayout();

        }

        #endregion
        private MaterialSkin.Controls.MaterialButton signupButton;
        private MaterialSkin.Controls.MaterialButton signinButton;
        private MaterialSkin.Controls.MaterialLabel materialLabel1;
        private MaterialSkin.Controls.MaterialTextBox login;
        private MaterialSkin.Controls.MaterialLabel materialLabel2;
        private MaterialSkin.Controls.MaterialLabel materialLabel3;
        private MaterialSkin.Controls.MaterialTextBox password;
        private MaterialSkin.Controls.MaterialTextBox passwordRepeat;
    }
}

