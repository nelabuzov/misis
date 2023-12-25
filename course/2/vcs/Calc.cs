using System;
using System.Windows.Forms;

namespace vcs
{
    public partial class Calc : Form
    {
        public Calc()
        {
            InitializeComponent();
        }

        // Объявление переменных
        double a = 0, b = 0, c = 0;
        char sign = '+';

        // Кнопки мат. операторов
        private void sign_Click(object sender, EventArgs e)
        {
            try
            {
                // Если строка не пустая
                if (textBox.Text != "")
                {
                    a = Convert.ToDouble(textBox.Text);
                    sign = (sender as Button).Text[0];
                    textBox.Clear();
                }
            }

            // Вывод ошибки
            catch (Exception ex)
            {
                MessageBox.Show(ex.Message.ToString(), "Ошибка");
            }
        }

        // Числа меньше нуля
        private void buttonType_Click(object sender, EventArgs e)
        {
            if (textBox.Text != "") textBox.Text = textBox.Text.Remove(0, 1);
            else textBox.Text = '-' + textBox.Text;
        }

        // Кнопка удаления символа
        private void buttonDelete_Click(object sender, EventArgs e)
        {
            if (textBox.Text != "") textBox.Text = textBox.Text.Remove(textBox.Text.Length - 1, 1);
        }

        // Кнопка очистки строки
        private void buttonClear_Click(object sender, EventArgs e)
        {
            textBox.Clear();
        }

        // Кнопка с числами
        private void digit_Click(object sender, EventArgs e)
        {
            textBox.Text += (sender as Button).Text;
        }

        // Кнопка равенства
        private void buttonEqual_Click(object sender, EventArgs e)
        {
            try
            {
                // Если строка не пустая
                if (textBox.Text != "")
                {
                    b = Convert.ToDouble(textBox.Text);

                    // Счет выражения
                    switch (sign)
                    {
                        case '+':
                            c = a + b;
                            break;
                        case '-':
                            c = a - b;
                            break;
                        case 'x':
                            c = a * b;
                            break;
                        case '/':
                            c = a / b;
                            break;
                    }
                    textBox.Text = c.ToString();
                }
                // Иначе сброс
                else
                {
                    textBox.Clear();
                }
            }

            // Вывод ошибки
            catch (Exception ex)
            {
                MessageBox.Show(ex.Message.ToString(), "Ошибка");
            }
        }
    }
}
