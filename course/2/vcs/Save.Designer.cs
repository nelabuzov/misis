namespace vcs
{
    partial class Save
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
            System.ComponentModel.ComponentResourceManager resources = new System.ComponentModel.ComponentResourceManager(typeof(Save));
            this.saveButton = new MaterialSkin.Controls.MaterialButton();
            this.materialLabel1 = new MaterialSkin.Controls.MaterialLabel();
            this.materialMultiLineTextBox = new MaterialSkin.Controls.MaterialMultiLineTextBox();
            this.SuspendLayout();
            // 
            // saveButton
            // 
            this.saveButton.AutoSizeMode = System.Windows.Forms.AutoSizeMode.GrowAndShrink;
            this.saveButton.Density = MaterialSkin.Controls.MaterialButton.MaterialButtonDensity.Default;
            this.saveButton.Depth = 0;
            this.saveButton.HighEmphasis = true;
            this.saveButton.Icon = null;
            this.saveButton.Location = new System.Drawing.Point(22, 225);
            this.saveButton.Margin = new System.Windows.Forms.Padding(4, 6, 4, 6);
            this.saveButton.MouseState = MaterialSkin.MouseState.HOVER;
            this.saveButton.Name = "saveButton";
            this.saveButton.NoAccentTextColor = System.Drawing.Color.Empty;
            this.saveButton.Size = new System.Drawing.Size(108, 36);
            this.saveButton.TabIndex = 1;
            this.saveButton.Text = "Отправить";
            this.saveButton.Type = MaterialSkin.Controls.MaterialButton.MaterialButtonType.Contained;
            this.saveButton.UseAccentColor = false;
            this.saveButton.UseVisualStyleBackColor = true;
            this.saveButton.Click += new System.EventHandler(this.saveButton_Click);
            // 
            // materialLabel1
            // 
            this.materialLabel1.AutoSize = true;
            this.materialLabel1.Depth = 0;
            this.materialLabel1.Font = new System.Drawing.Font("Roboto", 14F, System.Drawing.FontStyle.Regular, System.Drawing.GraphicsUnit.Pixel);
            this.materialLabel1.Location = new System.Drawing.Point(19, 88);
            this.materialLabel1.MouseState = MaterialSkin.MouseState.HOVER;
            this.materialLabel1.Name = "materialLabel1";
            this.materialLabel1.Size = new System.Drawing.Size(158, 19);
            this.materialLabel1.TabIndex = 37;
            this.materialLabel1.Text = "Опишите сохранение";
            // 
            // materialMultiLineTextBox
            // 
            this.materialMultiLineTextBox.BackColor = System.Drawing.Color.FromArgb(((int)(((byte)(255)))), ((int)(((byte)(255)))), ((int)(((byte)(255)))));
            this.materialMultiLineTextBox.BorderStyle = System.Windows.Forms.BorderStyle.None;
            this.materialMultiLineTextBox.Depth = 0;
            this.materialMultiLineTextBox.Font = new System.Drawing.Font("Microsoft Sans Serif", 14F, System.Drawing.FontStyle.Regular, System.Drawing.GraphicsUnit.Pixel);
            this.materialMultiLineTextBox.ForeColor = System.Drawing.Color.FromArgb(((int)(((byte)(222)))), ((int)(((byte)(0)))), ((int)(((byte)(0)))), ((int)(((byte)(0)))));
            this.materialMultiLineTextBox.Location = new System.Drawing.Point(22, 120);
            this.materialMultiLineTextBox.MaxLength = 200;
            this.materialMultiLineTextBox.MouseState = MaterialSkin.MouseState.HOVER;
            this.materialMultiLineTextBox.Multiline = false;
            this.materialMultiLineTextBox.Name = "materialMultiLineTextBox";
            this.materialMultiLineTextBox.Size = new System.Drawing.Size(229, 96);
            this.materialMultiLineTextBox.TabIndex = 38;
            this.materialMultiLineTextBox.Text = "База данных изменена";
            // 
            // Save
            // 
            this.AutoScaleDimensions = new System.Drawing.SizeF(6F, 13F);
            this.AutoScaleMode = System.Windows.Forms.AutoScaleMode.Font;
            this.ClientSize = new System.Drawing.Size(271, 278);
            this.Controls.Add(this.materialMultiLineTextBox);
            this.Controls.Add(this.materialLabel1);
            this.Controls.Add(this.saveButton);
            this.Icon = ((System.Drawing.Icon)(resources.GetObject("$this.Icon")));
            this.Name = "Save";
            this.StartPosition = System.Windows.Forms.FormStartPosition.CenterScreen;
            this.Text = "Комментарий";
            this.Load += new System.EventHandler(this.Commit_Load);
            this.ResumeLayout(false);
            this.PerformLayout();

        }

        #endregion
        private MaterialSkin.Controls.MaterialButton saveButton;
        private MaterialSkin.Controls.MaterialLabel materialLabel1;
        private MaterialSkin.Controls.MaterialMultiLineTextBox materialMultiLineTextBox;
    }
}