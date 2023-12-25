using MaterialSkin.Controls;
using System;
using System.Data.SqlClient;
using System.Windows.Forms;

namespace vcs
{
    public partial class Save : MaterialForm
    {
        public Save(string loginText)
        {
            InitializeComponent();
            this.loginText = loginText;
        }

        private string loginText;

        // Основное подключение к базе данных
        SqlConnection conVCS = new SqlConnection("Data Source = THELABUZOV; Initial Catalog = vcs; Integrated Security = True");

        private void Commit_Load(object sender, EventArgs e)
        {
            conVCS.Open();
        }

        public void saveButton_Click(object sender, EventArgs e)
        {
            try
            {
                if (materialMultiLineTextBox.TextLength < 8)
                {
                    MessageBox.Show("Недостаточно символов", "Комментарий");
                }
                else
                {
                    // Сохранение базы данных
                    string cmd_text = "BACKUP DATABASE vcs TO DISK = 'C:\\Users\\thelabuzov\\source\\repos\\vcs\\vcs\\Backup\\" +
                        $"({loginText})" + DateTime.Now.ToString(" d.MM.yy HH։mm։ss - ") + $"{materialMultiLineTextBox.Text}'";
                    SqlCommand sql_command = new SqlCommand(cmd_text, conVCS);
                    sql_command.ExecuteNonQuery();

                    MessageBox.Show("База данных сохранена", "Комментарий");
                    Close();
                }
            }
            catch (Exception ex)
            {
                MessageBox.Show(ex.Message.ToString(), "Ошибка");
            }
        }
    }
}
