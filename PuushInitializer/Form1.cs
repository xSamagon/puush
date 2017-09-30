using System;
using System.Collections.Generic;
using System.ComponentModel;
using System.Data;
using System.Drawing;
using System.IO;
using System.Linq;
using System.Text;
using System.Threading.Tasks;
using System.Windows.Forms;

namespace PuushInitializer
{
    public partial class Form1 : Form
    {
        public Form1()
        {
            InitializeComponent();
        }

        private void btnSet_Click(object sender, EventArgs e)
        {
            List<string> lines = new List<string>();
            try
            {
                StreamReader sr = new StreamReader(Environment.ExpandEnvironmentVariables(@"%AppData%\puush\puush.ini"));
                while (sr.Peek() >= 0)
                {
                    string txt = sr.ReadLine();
                    if (txt.StartsWith("ProxyServer") || txt.StartsWith("ProxyPort"))
                        continue;
                    lines.Add(txt);
                }
                lines.Add("ProxyServer = " + textBoxServer.Text);
                lines.Add("ProxyPort = " + textBoxPort.Text);
                sr.Close();
                StreamWriter sw = new StreamWriter(Environment.ExpandEnvironmentVariables(@"%AppData%\puush\puush.ini"), false);
                foreach (string line in lines)
                {
                    sw.WriteLine(line);
                }
                sw.Close();
                MessageBox.Show("Setted!");
            }
            catch (Exception ex)
            {
                MessageBox.Show("Can't open %appdata%/puush/puush.ini! Error: " + ex.Message);
            }
        }

        private void btnRemove_Click(object sender, EventArgs e)
        {
            List<string> lines = new List<string>();
            try
            {
                StreamReader sr = new StreamReader(Environment.ExpandEnvironmentVariables(@"%AppData%\puush\puush.ini"));
                while (sr.Peek() >= 0)
                {
                    string txt = sr.ReadLine();
                    if (txt.StartsWith("ProxyServer") || txt.StartsWith("ProxyPort"))
                        continue;
                    lines.Add(txt);
                }
                lines.Add("ProxyServer = ");
                lines.Add("ProxyPort = ");
                sr.Close();
                StreamWriter sw = new StreamWriter(Environment.ExpandEnvironmentVariables(@"%AppData%\puush\puush.ini"), false);
                foreach (string line in lines)
                {
                    sw.WriteLine(line);
                }
                sw.Close();
                MessageBox.Show("Removed!");
            }
            catch (Exception ex)
            {
                MessageBox.Show("Can't open %appdata%/puush/puush.ini! Error: " + ex.Message);
            }
        }
    }
}
