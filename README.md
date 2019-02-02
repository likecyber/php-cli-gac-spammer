# GAC Spammer
The open source version of GAC (Grab Activation Code) Spammer written in PHP for CLI.

```cmd
Usage: php GAC_Spammer.php <phone_number> [SMS|CALL|ALL]
```

---

## Disclaimer
This project is intended for educational purposes only. Developer is not responsible for any misuse.

---

### Changelog
- Spamming will now continue 1 second after last request instead of 30 seconds for best efficiency. (2019-02-03)
- Request CALL OTP will be made from 8 different countries. (2019-02-03)
- Spamming SMS and CALL at once is possible by "ALL" spam-type.  (2019-02-03)
- Succeed OTP Request output will now show spam-type. (2019-02-03)
- Unusual Response Warning output will now be removed. (2019-02-03)
- Hit number on the title will now parse to Number Format. (2019-02-03)
