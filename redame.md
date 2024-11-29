Behavior
- go live
- go to http://127.0.0.1:5500/index.html?url=profile.html
- click on profile button
- go to profile.html opened
- open console and check document.referrer and window.opener, all information will be showed

Malicious actor knowing this mechanism can pack a new url pointing to his personal page and use that information for the next attack

Hack
- go to attacker forlder in console and launch php -S localhost:8000
- go to http://127.0.0.1:5500/index.html?url=attacker/trustedsite.html
- click on profile button
- while navigating in trustedsite original tab will change to phishingsite
- back to original tab and see the tramp, it's a login form identical to the original
- fill the form and enjoy!
- hacker will receive your credentials in received_data.txt


Mitigation
- use noreferrer policy
- use noopener policy
- repite the hack, it won't work anymore