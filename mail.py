import requests
import sys
email_id = sys.argv[1]
message =""
for i in range(2,len(sys.argv)):
    message+=" "+sys.argv[i]
def send_simple_message(e_id,mess):
    return requests.post(
        "https://api.mailgun.net/v3/sandboxa889103b5ee248bc975907fec937200c.mailgun.org/messages",
        auth=("api", "99bcfbc2c1cebdc3e731d19b4715f521-115fe3a6-832f7e0a"),
        data={"from": "Mailgun Sandbox <postmaster@sandboxa889103b5ee248bc975907fec937200c.mailgun.org>",              
	"to": [e_id],
              "subject": "Report",
              "text": mess})
print email_id
send_simple_message(email_id,message)



