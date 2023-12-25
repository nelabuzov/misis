namespace vcs
{
    partial class Profile
    {
        /// <summary>
        /// Required designer variable.
        /// </summary>
        private System.ComponentModel.IContainer components = null;

        /// <summary>
        /// Clean up any resources being used.
        /// </summary>
        /// <param name="disposing">true if managed resources should be disposed; otherwise, false.</param>
        protected override void Dispose(bool disposing)
        {
            if (disposing && (components != null))
            {
                components.Dispose();
            }
            base.Dispose(disposing);
        }

        #region Windows Form Designer generated code

        /// <summary>
        /// Required method for Designer support - do not modify
        /// the contents of this method with the code editor.
        /// </summary>
        private void InitializeComponent()
        {
            System.ComponentModel.ComponentResourceManager resources = new System.ComponentModel.ComponentResourceManager(typeof(Profile));
            this.passwordNew = new MaterialSkin.Controls.MaterialTextBox();
            this.password = new MaterialSkin.Controls.MaterialTextBox();
            this.newPasswordLabel = new MaterialSkin.Controls.MaterialLabel();
            this.passwordLabel = new MaterialSkin.Controls.MaterialLabel();
            this.deleteButton = new MaterialSkin.Controls.MaterialButton();
            this.changeButton = new MaterialSkin.Controls.MaterialButton();
            this.SuspendLayout();
            // 
            // passwordNew
            // 
            this.passwordNew.AnimateReadOnly = false;
            this.passwordNew.BorderStyle = System.Windows.Forms.BorderStyle.None;
            this.passwordNew.Depth = 0;
            this.passwordNew.Font = new System.Drawing.Font("Roboto", 16F, System.Drawing.FontStyle.Regular, System.Drawing.GraphicsUnit.Pixel);
            this.passwordNew.LeadingIcon = null;
            this.passwordNew.LeaveOnEnterKey = true;
            this.passwordNew.Location = new System.Drawing.Point(15, 199);
            this.passwordNew.MaxLength = 50;
            this.passwordNew.MouseState = MaterialSkin.MouseState.OUT;
            this.passwordNew.Multiline = false;
            this.passwordNew.Name = "passwordNew";
            this.passwordNew.Password = true;
            this.passwordNew.Size = new System.Drawing.Size(370, 50);
            this.passwordNew.TabIndex = 3;
            this.passwordNew.Text = "";
            this.passwordNew.TrailingIcon = null;
            // 
            // password
            // 
            this.password.AnimateReadOnly = false;
            this.password.BorderStyle = System.Windows.Forms.BorderStyle.None;
            this.password.Depth = 0;
            this.password.Font = new System.Drawing.Font("Roboto", 16F, System.Drawing.FontStyle.Regular, System.Drawing.GraphicsUnit.Pixel);
            this.password.LeadingIcon = null;
            this.password.Location = new System.Drawing.Point(15, 99);
            this.password.MaxLength = 50;
            this.password.MouseState = MaterialSkin.MouseState.OUT;
            this.password.Multiline = false;
            this.password.Name = "password";
            this.password.Password = true;
            this.password.Size = new System.Drawing.Size(370, 50);
            this.password.TabIndex = 2;
            this.password.Text = "";
            this.password.TrailingIcon = null;
            // 
            // newPasswordLabel
            // 
            this.newPasswordLabel.AutoSize = true;
            this.newPasswordLabel.Depth = 0;
            this.newPasswordLabel.Font = new System.Drawing.Font("Roboto", 14F, System.Drawing.FontStyle.Regular, System.Drawing.GraphicsUnit.Pixel);
            this.newPasswordLabel.Location = new System.Drawing.Point(12, 177);
            this.newPasswordLabel.MouseState = MaterialSkin.MouseState.HOVER;
            this.newPasswordLabel.Name = "newPasswordLabel";
            this.newPasswordLabel.Size = new System.Drawing.Size(109, 19);
            this.newPasswordLabel.TabIndex = 37;
            this.newPasswordLabel.Text = "Новый пароль";
            // 
            // passwordLabel
            // 
            this.passwordLabel.AutoSize = true;
            this.passwordLabel.Depth = 0;
            this.passwordLabel.Font = new System.Drawing.Font("Roboto", 14F, System.Drawing.FontStyle.Regular, System.Drawing.GraphicsUnit.Pixel);
            this.passwordLabel.Location = new System.Drawing.Point(12, 77);
            this.passwordLabel.MouseState = MaterialSkin.MouseState.HOVER;
            this.passwordLabel.Name = "passwordLabel";
            this.passwordLabel.Size = new System.Drawing.Size(121, 19);
            this.passwordLabel.TabIndex = 36;
            this.passwordLabel.Text = "Введите пароль";
            // 
            // deleteButton
            // 
            this.deleteButton.AutoSizeMode = System.Windows.Forms.AutoSizeMode.GrowAndShrink;
            this.deleteButton.Density = MaterialSkin.Controls.MaterialButton.MaterialButtonDensity.Default;
            this.deleteButton.Depth = 0;
            this.deleteButton.HighEmphasis = true;
            this.deleteButton.Icon = null;
            this.deleteButton.Location = new System.Drawing.Point(219, 270);
            this.deleteButton.Margin = new System.Windows.Forms.Padding(4, 6, 4, 6);
            this.deleteButton.MouseState = MaterialSkin.MouseState.HOVER;
            this.deleteButton.Name = "deleteButton";
            this.deleteButton.NoAccentTextColor = System.Drawing.Color.Empty;
            this.deleteButton.Size = new System.Drawing.Size(166, 36);
            this.deleteButton.TabIndex = 6;
            this.deleteButton.Text = "Удалить профиль";
            this.deleteButton.Type = MaterialSkin.Controls.MaterialButton.MaterialButtonType.Contained;
            this.deleteButton.UseAccentColor = false;
            this.deleteButton.UseVisualStyleBackColor = true;
            this.deleteButton.Click += new System.EventHandler(this.deleteButton_Click);
            // 
            // changeButton
            // 
            this.changeButton.AutoSizeMode = System.Windows.Forms.AutoSizeMode.GrowAndShrink;
            this.changeButton.Density = MaterialSkin.Controls.MaterialButton.MaterialButtonDensity.Default;
            this.changeButton.Depth = 0;
            this.changeButton.HighEmphasis = true;
            this.changeButton.Icon = null;
            this.changeButton.Location = new System.Drawing.Point(15, 270);
            this.changeButton.Margin = new System.Windows.Forms.Padding(4, 6, 4, 6);
            this.changeButton.MouseState = MaterialSkin.MouseState.HOVER;
            this.changeButton.Name = "changeButton";
            this.changeButton.NoAccentTextColor = System.Drawing.Color.Empty;
            this.changeButton.Size = new System.Drawing.Size(165, 36);
            this.changeButton.TabIndex = 4;
            this.changeButton.Text = "Изменить пароль";
            this.changeButton.Type = MaterialSkin.Controls.MaterialButton.MaterialButtonType.Contained;
            this.changeButton.UseAccentColor = false;
            this.changeButton.UseVisualStyleBackColor = true;
            this.changeButton.Click += new System.EventHandler(this.changeButton_Click);
            // 
            // Profile
            // 
            this.AutoScaleDimensions = new System.Drawing.SizeF(6F, 13F);
            this.AutoScaleMode = System.Windows.Forms.AutoScaleMode.Font;
            this.ClientSize = new System.Drawing.Size(400, 329);
            this.Controls.Add(this.passwordNew);
            this.Controls.Add(this.password);
            this.Controls.Add(this.newPasswordLabel);
            this.Controls.Add(this.passwordLabel);
            this.Controls.Add(this.deleteButton);
            this.Controls.Add(this.changeButton);
            this.Icon = ((System.Drawing.Icon)(resources.GetObject("$this.Icon")));
            this.Name = "Profile";
            this.StartPosition = System.Windows.Forms.FormStartPosition.CenterScreen;
            this.Text = "Пользователь";
            this.Load += new System.EventHandler(this.Account_Load);
            this.ResumeLayout(false);
            this.PerformLayout();

        }

        #endregion

        private MaterialSkin.Controls.MaterialTextBox passwordNew;
        private MaterialSkin.Controls.MaterialTextBox password;
        private MaterialSkin.Controls.MaterialLabel newPasswordLabel;
        private MaterialSkin.Controls.MaterialLabel passwordLabel;
        private MaterialSkin.Controls.MaterialButton deleteButton;
        private MaterialSkin.Controls.MaterialButton changeButton;
    }
}