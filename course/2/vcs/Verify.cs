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
    public partial class Verify : MaterialForm
    {
        // Основное подключение к базе данных
        SqlConnection conVCS = new SqlConnection("Data Source = THELABUZOV; Initial Catalog = vcs; Integrated Security = True");

        public Verify()
        {
            InitializeComponent();
        }

        // Загрузка формы
        private void User_Load(object sender, EventArgs e)
        {
            conVCS.Open();
        }

        private void Verify_FormClosing(object sender, FormClosingEventArgs e)
        {
            if (e.CloseReason == CloseReason.UserClosing)
            {
                Environment.Exit(0);
            }
        }

        // Регистрация
        private void signupButton_Click(object sender, EventArgs e)
        {
            try
            {
                // Если поля не заполнены
                if ((login.Text == "") || (password.Text == "") || (passwordRepeat.Text == ""))
                {
                    MessageBox.Show("Заполните все поля", "Верификация");
                }
                // Если пароли не совпадают
                else if (password.Text != passwordRepeat.Text)
                {
                    MessageBox.Show("Пароли не совпадают", "Верификация");
                }
                // Если не латиница
                else if (Regex.IsMatch(login.Text, @"\p{IsCyrillic}") && Regex.IsMatch(password.Text, @"\p{IsCyrillic}") && Regex.IsMatch(passwordRepeat.Text, @"\p{IsCyrillic}"))
                {
                    MessageBox.Show("Введите латинские символы", "Верификация");
                }
                // Если недостаточно символов
                else if (login.TextLength < 8 || password.TextLength < 8 || passwordRepeat.TextLength < 8)
                {
                    MessageBox.Show("Недостаточно символов", "Верификация");
                }
                else
                {
                    // Если аккаунт уже зарегистрирован
                    DataTable table = new DataTable();
                    SqlDataAdapter adapter = new SqlDataAdapter();
                    SqlCommand cmd = new SqlCommand("SELECT логин FROM аккаунты WHERE логин = @login", conVCS);
                    cmd.Parameters.Add("@login", SqlDbType.VarChar).Value = login.Text;
                    adapter.SelectCommand = cmd;
                    adapter.Fill(table);

                    if (table.Rows.Count > 0)
                    {
                        MessageBox.Show("Придумайте другой логин", "Верификация");
                    }
                    else
                    {
                        var md5 = MD5.Create();
                        var compute = md5.ComputeHash(Encoding.UTF8.GetBytes(password.Text));
                        var hash = Convert.ToBase64String(compute);

                        // Создание нового аккаунта в базе данных
                        SqlCommand command = new SqlCommand("INSERT INTO аккаунты (логин, пароль) VALUES (@login, @password)", conVCS);
                        command.Parameters.Add("@login", SqlDbType.VarChar).Value = login.Text;
                        command.Parameters.Add("@password", SqlDbType.VarChar).Value = hash;
                        command.ExecuteNonQuery();

                        // Перевод логина пользователя
                        string loginText = login.Text;
                        Main newForm = new Main(loginText);
                        newForm.Show(this);
                        Hide();
                    }
                }
            }

            catch (Exception ex)
            {
                MessageBox.Show(ex.Message.ToString(), "Ошибка");
            }
        }

        // Авторизация
        private void signinButton_Click(object sender, EventArgs e)
        {
            try
            {
                if (password.Text != passwordRepeat.Text)
                {
                    MessageBox.Show("Пароли не совпадают", "Верификация");
                }
                else
                {
                    var md5 = MD5.Create();
                    var compute = md5.ComputeHash(Encoding.UTF8.GetBytes(password.Text));
                    var hash = Convert.ToBase64String(compute);

                    // Авторизация аккаунта в базе данных
                    DataTable table = new DataTable();
                    SqlDataAdapter adapter = new SqlDataAdapter();
                    SqlCommand command = new SqlCommand("SELECT логин, пароль FROM аккаунты WHERE логин = @login AND пароль = @password", conVCS);
                    command.Parameters.Add("@login", SqlDbType.VarChar).Value = login.Text;
                    command.Parameters.Add("@password", SqlDbType.VarChar).Value = hash;
                    adapter.SelectCommand = command;
                    adapter.Fill(table);

                    if (table.Rows.Count > 0)
                    {
                        // Перевод логина пользователя
                        string loginText = login.Text;
                        Main newForm = new Main(loginText);
                        newForm.Show(this);
                        Hide();
                    }
                    else
                    {
                        MessageBox.Show("Пользователя не существует", "Верификация");
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