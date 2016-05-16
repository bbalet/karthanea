using System;
using System.Collections.Generic;
using System.Collections.Specialized;
using System.Net;
using System.Windows.Forms;
using Newtonsoft.Json;

namespace CSharpClient
{
    public partial class frmMain : Form
    {
        public frmMain()
        {
            InitializeComponent();
        }

        /// <summary>
        /// On double click on a datatable cell, load the client details from REST API
        /// </summary>
        /// <param name="sender"></param>
        /// <param name="e"></param>
        private void tblTests_CellDoubleClick(object sender, DataGridViewCellEventArgs e)
        {
            int l_intClientID = Convert.ToInt32(this.tblTests.Rows[e.RowIndex].Cells[0].Value.ToString());
            string l_strClientURL = "clients/" + l_intClientID;
            using (WebClient l_objWClient = new WebClient())
            {
                l_objWClient.BaseAddress = txtBaseURL.Text;
                try
                {
                    byte[] l_objResponse = l_objWClient.UploadValues(l_strClientURL, new NameValueCollection()
                   {
                       { "login", txtLogin.Text },
                       { "password", txtPassword.Text }
                   });
                    string l_strResult = System.Text.Encoding.UTF8.GetString(l_objResponse);
                    Client l_objClient = JsonConvert.DeserializeObject<Client>(l_strResult);
                    frmClientView l_objFrmStepsView = new frmClientView(l_objClient);
                    l_objFrmStepsView.ShowDialog();
                }
                catch (WebException l_objException)
                {
                    MessageBox.Show(l_objException.Message);
                }
            }
        }

        /// <summary>
        /// Get the list of tests (REST API)
        /// </summary>
        /// <param name="sender"></param>
        /// <param name="e"></param>
        private void cmdGetTests_Click(object sender, EventArgs e)
        {
            using (WebClient l_objWClient = new WebClient())
            {
                l_objWClient.BaseAddress = txtBaseURL.Text;
                try
                {
                   byte[] l_objResponse = l_objWClient.UploadValues("clients", new NameValueCollection()
                   {
                       { "login", txtLogin.Text },
                       { "password", txtPassword.Text }
                   });
                    string l_strResult = System.Text.Encoding.UTF8.GetString(l_objResponse);
                    List<Client> l_lstClients = JsonConvert.DeserializeObject<List<Client>>(l_strResult);
                    this.tblTests.Rows.Clear();
                    foreach (Client l_objClient in l_lstClients)
                    {
                        tblTests.Rows.Add(l_objClient.Id,
                            l_objClient.Firstname,
                            l_objClient.Lastname);
                    }
                }
                catch (WebException l_objException)
                {
                    MessageBox.Show(l_objException.Message);
                }
            }
        }
    }
}
