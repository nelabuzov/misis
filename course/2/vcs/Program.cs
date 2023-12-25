using System.Windows.Forms;

namespace vcs
{
    internal static class Program
    {
        static void Main()
        {
            Application.EnableVisualStyles();
            Application.SetCompatibleTextRenderingDefault(false);
            Application.Run(new Verify());
        }
    }
}
