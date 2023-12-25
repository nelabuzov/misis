using System;
using System.Data.SqlClient;
using System.Windows.Forms;
using System.IO;
using MaterialSkin.Controls;

namespace vcs
{
    public partial class Main : MaterialForm
    {
        // Основное подключение к базе данных
        SqlConnection conVCS = new SqlConnection("Data Source = THELABUZOV; Initial Catalog = vcs; Integrated Security = True");

        // Подключение для загрузки базы данных
        SqlConnection conIMP = new SqlConnection("Data Source = THELABUZOV; Initial Catalog = master; Integrated Security = True");

        public Main(string loginText)
        {
            InitializeComponent();
            this.loginText = loginText;

            дата_записи.Text = DateTime.Now.ToShortDateString();
            дата_записи.Format = DateTimePickerFormat.Custom;
            дата_записи.CustomFormat = "dd.MM.yyyy";
            дата_записи.ShowUpDown = false;

            дата_рождения.Text = DateTime.Now.ToShortDateString();
            дата_рождения.Format = DateTimePickerFormat.Custom;
            дата_рождения.CustomFormat = "dd.MM.yyyy";
            дата_рождения.ShowUpDown = false;
        }

        private string loginText;

        // Загрузка формы
        private void Main_Load(object sender, EventArgs e)
        {
            // Загрузка сохранений
            var dir = new DirectoryInfo("..\\..\\Backup");
            FileInfo[] backup = dir.GetFiles("*.*", SearchOption.AllDirectories);
            listBox.DataSource = backup;

            // Подключения
            conVCS.Open();
            conIMP.Open();

            // Загрузка таблиц
            записиTableAdapter.Fill(vcsDataSet.записи);
            врачиTableAdapter.Fill(vcsDataSet.врачи);
            диагнозыTableAdapter.Fill(vcsDataSet.диагнозы);
            пациентыTableAdapter.Fill(vcsDataSet.пациенты);
        }

        // Закрытие формы
        private void Main_FormClosed(object sender, FormClosedEventArgs e)
        {
            Application.Exit();
        }

        // Обновление формы
        private void bindingNavigatorLoadItem_Click(object sender, EventArgs e)
        {
            // Загрузка сохранений
            var dir = new DirectoryInfo("..\\..\\Backup");
            FileInfo[] backup = dir.GetFiles("*.*", SearchOption.AllDirectories);
            listBox.DataSource = backup;

            // Загрузка таблиц
            записиTableAdapter.Fill(vcsDataSet.записи);
            врачиTableAdapter.Fill(vcsDataSet.врачи);
            диагнозыTableAdapter.Fill(vcsDataSet.диагнозы);
            пациентыTableAdapter.Fill(vcsDataSet.пациенты);
        }

        // Добавление строки
        private void bindingNavigatorAddNewItem_Click(object sender, EventArgs e)
        {
            try
            {
                // Если 1 таблица активна
                if (dataGridView1.Visible == true)
                {
                    string cmd_text = "INSERT INTO записи VALUES ('" + id_врача.Text
                        + "', '" + id_диагноза.Text
                        + "', '" + id_пациента.Text
                        + "', '" + номер_талона.Text
                        + "', '" + дата_записи.Text
                        + "', '" + стоимость.Text + "')";
                    SqlCommand sql_command = new SqlCommand(cmd_text, conVCS);
                    sql_command.ExecuteNonQuery();
                    записиTableAdapter.Fill(vcsDataSet.записи);
                }
                // Если 2 таблица активна
                else if (dataGridView2.Visible == true)
                {
                    string cmd_text = "INSERT INTO врачи VALUES ('" + фамилия_врача.Text
                        + "', '" + имя_врача.Text
                        + "', '" + отчество_врача.Text
                        + "', '" + специальность.Text
                        + "', '" + стаж_работы.Text + "')";
                    SqlCommand sql_command = new SqlCommand(cmd_text, conVCS);
                    sql_command.ExecuteNonQuery();
                    врачиTableAdapter.Fill(vcsDataSet.врачи);
                }
                // Если 3 таблица активна
                else if (dataGridView3.Visible == true)
                {
                    string cmd_text = "INSERT INTO диагнозы VALUES ('" + название.Text + "')";
                    SqlCommand sql_command = new SqlCommand(cmd_text, conVCS);
                    sql_command.ExecuteNonQuery();
                    диагнозыTableAdapter.Fill(vcsDataSet.диагнозы);
                }
                // Если 4 таблица активна
                else
                {
                    string cmd_text = "INSERT INTO пациенты VALUES ('" + фамилия_пациента.Text
                        + "', '" + имя_пациента.Text
                        + "', '" + отчество_пациента.Text
                        + "', '" + адрес.Text
                        + "', '" + пол.Text
                        + "', '" + дата_рождения.Text + "')";
                    SqlCommand sql_command = new SqlCommand(cmd_text, conVCS);
                    sql_command.ExecuteNonQuery();
                    пациентыTableAdapter.Fill(vcsDataSet.пациенты);
                }
            }

            catch (Exception ex)
            {
                MessageBox.Show(ex.Message.ToString(), "Ошибка");
            }
        }

        // Изменение строки
        private void bindingNavigatorChangeItem_Click(object sender, EventArgs e)
        {
            try
            {
                // Если 1 таблица активна
                if (dataGridView1.Visible == true)
                {
                    int index = dataGridView1.CurrentRow.Index;
                    string id_записи = Convert.ToString(dataGridView1[0, index].Value);
                    string cmd_text = "UPDATE записи SET id_врача = '" + id_врача.Text
                        + "', id_диагноза = '" + id_диагноза.Text
                        + "', id_пациента = '" + id_пациента.Text
                        + "', номер_талона = '" + номер_талона.Text
                        + "', дата_записи = '" + дата_записи.Text
                        + "', стоимость = '" + стоимость.Text
                        + "' WHERE id_записи = '" + id_записи + "'";
                    SqlCommand sql_command = new SqlCommand(cmd_text, conVCS);
                    sql_command.ExecuteNonQuery();
                    записиTableAdapter.Fill(vcsDataSet.записи);
                }
                // Если 2 таблица активна
                else if (dataGridView2.Visible == true)
                {
                    int index = dataGridView2.CurrentRow.Index;
                    string id_врача = Convert.ToString(dataGridView2[0, index].Value);
                    string cmd_text = "UPDATE записи SET фамилия = '" + фамилия_врача.Text
                        + "', имя = '" + имя_врача.Text
                        + "', отчество = '" + отчество_врача.Text
                        + "', специальность = '" + специальность.Text
                        + "', стаж_работы = '" + стаж_работы.Text
                        + "' WHERE id_врача = '" + id_врача + "'";
                    SqlCommand sql_command = new SqlCommand(cmd_text, conVCS);
                    sql_command.ExecuteNonQuery();
                    врачиTableAdapter.Fill(vcsDataSet.врачи);
                }
                // Если 3 таблица активна
                else if (dataGridView3.Visible == true)
                {
                    int index = dataGridView3.CurrentRow.Index;
                    string id_диагноза = Convert.ToString(dataGridView3[0, index].Value);
                    string cmd_text = "UPDATE диагнозы SET название = '" + название.Text
                        + "' WHERE id_диагноза = '" + id_диагноза + "'";
                    SqlCommand sql_command = new SqlCommand(cmd_text, conVCS);
                    sql_command.ExecuteNonQuery();
                    диагнозыTableAdapter.Fill(vcsDataSet.диагнозы);
                }
                // Если 4 таблица активна
                else
                {
                    int index = dataGridView4.CurrentRow.Index;
                    string id_пациента = Convert.ToString(dataGridView4[0, index].Value);
                    string cmd_text = "UPDATE пациенты SET фамилия = '" + фамилия_пациента.Text
                        + "', имя = '" + имя_пациента.Text
                        + "', отчество = '" + отчество_пациента.Text
                        + "', адрес = '" + адрес.Text
                        + "', пол = '" + пол.Text
                        + "', дата_рождения = '" + дата_рождения.Text
                        + "' WHERE id_пациента = '" + id_пациента + "'";
                    SqlCommand sql_command = new SqlCommand(cmd_text, conVCS);
                    sql_command.ExecuteNonQuery();
                    пациентыTableAdapter.Fill(vcsDataSet.пациенты);
                }
            }

            catch (Exception ex)
            {
                MessageBox.Show(ex.Message.ToString(), "Ошибка");
            }
        }

        // Удаление строки
        private void bindingNavigatorDeleteItem_Click(object sender, EventArgs e)
        {
            try
            {
                // Если 1 таблица активна
                if (dataGridView1.Visible == true)
                {
                    int index = dataGridView1.CurrentRow.Index;
                    string id_записи = Convert.ToString(dataGridView1[0, index].Value);
                    string cmd_text = "DELETE FROM записи WHERE id_записи = '" + id_записи + "'";
                    SqlCommand sql_command = new SqlCommand(cmd_text, conVCS);
                    sql_command.ExecuteNonQuery();
                    записиTableAdapter.Fill(vcsDataSet.записи);
                }
                // Если 2 таблица активна
                else if (dataGridView2.Visible == true)
                {
                    int index = dataGridView2.CurrentRow.Index;
                    string id_врача = Convert.ToString(dataGridView2[0, index].Value);
                    string cmd_text = "DELETE FROM врачи WHERE id_врача = '" + id_врача + "'";
                    SqlCommand sql_command = new SqlCommand(cmd_text, conVCS);
                    sql_command.ExecuteNonQuery();
                    врачиTableAdapter.Fill(vcsDataSet.врачи);
                }
                // Если 3 таблица активна
                else if (dataGridView3.Visible == true)
                {
                    int index = dataGridView3.CurrentRow.Index;
                    string id_диагноза = Convert.ToString(dataGridView3[0, index].Value);
                    string cmd_text = "DELETE FROM диагнозы WHERE id_диагноза = '" + id_диагноза + "'";
                    SqlCommand sql_command = new SqlCommand(cmd_text, conVCS);
                    sql_command.ExecuteNonQuery();
                    диагнозыTableAdapter.Fill(vcsDataSet.диагнозы);
                }
                // Если 4 таблица активна
                else
                {
                    int index = dataGridView4.CurrentRow.Index;
                    string id_пациента = Convert.ToString(dataGridView4[0, index].Value);
                    string cmd_text = "DELETE FROM пациенты WHERE id_пациента = '" + id_пациента + "'";
                    SqlCommand sql_command = new SqlCommand(cmd_text, conVCS);
                    sql_command.ExecuteNonQuery();
                    пациентыTableAdapter.Fill(vcsDataSet.пациенты);
                }
            }

            catch (Exception ex)
            {
                MessageBox.Show(ex.Message.ToString(), "Ошибка");
            }
        }

        // Запуск калькулятора
        private void bindingNavigatorCalc_Click(object sender, EventArgs e)
        {
            Calc newForm = new Calc();
            newForm.Show();
        }

        // Запуск описания программы
        private void bindingNavigatorAbout_Click(object sender, EventArgs e)
        {
            About newForm = new About();
            newForm.Show();
        }

        // Запуск редактора аккаунта
        private void bindingNavigatorProfile_Click(object sender, EventArgs e)
        {
            Profile newForm = new Profile(loginText);
            newForm.Show();
        }

        // Запуск формы сохранения
        public void bindingNavigatorSave_Click(object sender, EventArgs e)
        {
            Save newForm = new Save(loginText);
            newForm.Show(this);
        }

        // Загрузка базы данных
        private void listBox_DoubleClick(object sender, EventArgs e)
        {
            // Загрузка базы данных
            string fileName = "C:\\Users\\thelabuzov\\source\\repos\\vcs\\vcs\\Backup\\" + listBox.SelectedItem;
            string cmd_text = "ALTER DATABASE vcs SET SINGLE_USER WITH ROLLBACK IMMEDIATE;"
                + " RESTORE DATABASE vcs FROM DISK = '" + fileName + "' WITH REPLACE;"
                + " ALTER DATABASE vcs SET MULTI_USER";
            SqlCommand command = new SqlCommand(cmd_text, conIMP);
            command.ExecuteNonQuery();

            MessageBox.Show("База данных загружена", "Главная");
        }

        // Переключение вкладок
        private void tabControl_SelectedIndexChanged(object sender, EventArgs e)
        {
            try
            {
                // Если 1 таблица активна
                if (dataGridView1.Visible == true)
                {
                    bindingNavigator.BindingSource = записиBindingSource;
                }
                // Если 2 таблица активна
                else if (dataGridView2.Visible == true)
                {
                    bindingNavigator.BindingSource = врачиBindingSource;
                }
                // Если 3 таблица активна
                else if (dataGridView3.Visible == true)
                {
                    bindingNavigator.BindingSource = диагнозыBindingSource;
                }
                // Если 4 таблица активна
                else
                {
                    bindingNavigator.BindingSource = пациентыBindingSource;
                }
            }

            catch (Exception ex)
            {
                MessageBox.Show(ex.Message.ToString(), "Ошибка");
            }
        }
    }
}
