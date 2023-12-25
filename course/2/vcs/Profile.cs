using MaterialSkin.Controls;
using System;
using System.Data;
using System.Data.SqlClient;
using System.Security.Cryptography;
using System.Text;
using System.Text.RegularExpressions;
using System.Windows.Forms;

namespace vcs
{
    public partial class Profile : MaterialForm
    {
        public Profile(string loginText)
        {
            InitializeComponent();
            this.loginText = loginText;
        }

        private string loginText;

        // Основное подключение к базе данных
        SqlConnection conVCS = new SqlConnection("Data Source = THELABUZOV; Initial Catalog = vcs; Integrated Security = True");

        public Profile()
        {
            InitializeComponent();
        }

        private void Account_Load(object sender, EventArgs e)
        {
            conVCS.Open();
        }

        private void deleteButton_Click(object sender, EventArgs e)
        {
            try
            {
                // Если поля не заполнены
                if ((password.Text == ""))
                {
                    MessageBox.Show("Заполните пароль", "Пользователь");
                }
                // Если не латиница
                else if (Regex.IsMatch(password.Text, @"\p{IsCyrillic}"))
                {
                    MessageBox.Show("Введите латинский пароль", "Пользователь");
                }
                // Если недостаточно символов
                else if (password.TextLength < 8)
                {
                    MessageBox.Show("Мало символов пароля", "Пользователь");
                }
                else
                {
                    var md5 = MD5.Create();
                    var compute = md5.ComputeHash(Encoding.UTF8.GetBytes(password.Text));
                    var hash = Convert.ToBase64String(compute);

                    DataTable table = new DataTable();
                    SqlDataAdapter adapter = new SqlDataAdapter();
                    SqlCommand command = new SqlCommand("SELECT логин, пароль FROM аккаунты WHERE логин = @login AND пароль = @password", conVCS);
                    command.Parameters.Add("@login", SqlDbType.VarChar).Value = loginText;
                    command.Parameters.Add("@password", SqlDbType.VarChar).Value = hash;
                    adapter.SelectCommand = command;
                    adapter.Fill(table);

                    if (table.Rows.Count > 0)
                    {
                        string cmd_text = "DELETE FROM аккаунты WHERE логин = '" + loginText + "'";
                        SqlCommand sql_command = new SqlCommand(cmd_text, conVCS);
                        sql_command.ExecuteNonQuery();

                        Application.Exit();
                    }
                    else
                    {
                        MessageBox.Show("Пользователя не существует", "Пользователь");
                    }
                }
            }

            catch (Exception ex)
            {
                MessageBox.Show(ex.Message.ToString(), "Ошибка");
            }
        }

        private void changeButton_Click(object sender, EventArgs e)
        {
            try
            {
                // Если поля не заполнены
                if ((password.Text == "") || (passwordNew.Text == ""))
                {
                    MessageBox.Show("Заполните все поля", "Пользователь");
                }
                // Если не латиница
                else if (Regex.IsMatch(password.Text, @"\p{IsCyrillic}") && Regex.IsMatch(passwordNew.Text, @"\p{IsCyrillic}"))
                {
                    MessageBox.Show("Введите латинские символы", "Пользователь");
                }
                // Если недостаточно символов
                else if (password.TextLength < 8 || passwordNew.TextLength < 8)
                {
                    MessageBox.Show("Недостаточно символов", "Пользователь");
                }
                else
                {
                    var md5 = MD5.Create();
                    var compute = md5.ComputeHash(Encoding.UTF8.GetBytes(password.Text));
                    var hash = Convert.ToBase64String(compute);

                    DataTable table = new DataTable();
                    SqlDataAdapter adapter = new SqlDataAdapter();
                    SqlCommand command = new SqlCommand("SELECT логин, пароль FROM аккаунты WHERE логин = @login AND пароль = @password", conVCS);
                    command.Parameters.Add("@login", SqlDbType.VarChar).Value = loginText;
                    command.Parameters.Add("@password", SqlDbType.VarChar).Value = hash;
                    adapter.SelectCommand = command;
                    adapter.Fill(table);

                    if (table.Rows.Count > 0)
                    {
                        var crypt = MD5.Create();
                        var solve = crypt.ComputeHash(Encoding.UTF8.GetBytes(passwordNew.Text));
                        var hashing = Convert.ToBase64String(solve);

                        SqlCommand cmd = new SqlCommand("UPDATE аккаунты SET пароль = @password WHERE логин = @login", conVCS);
                        cmd.Parameters.Add("@login", SqlDbType.VarChar).Value = loginText;
                        cmd.Parameters.Add("@password", SqlDbType.VarChar).Value = hashing;
                        cmd.ExecuteNonQuery();

                        MessageBox.Show("Пароль изменен", "Пользователь");
                    }
                    else
                    {
                        MessageBox.Show("Пользователя не существует", "Пользователь");
                    }
                }
            }

            catch (Exception ex)
            {
                MessageBox.Show(ex.Message.ToString(), "Ошибка");
            }
        }
    }
}
