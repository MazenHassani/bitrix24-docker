# External deployment credentials

Before starting the application, provision `/etc/bitrix/credentials.php` outside the web root, using `credentials.example.php` as a schema. Replace every placeholder locally, restrict filesystem permissions, and mount the file read-only into the container. Do not bake real credentials into an image or commit them. Both Bitrix database configuration paths read the same external settings. Ordinary author names and vendor attribution are unchanged.

For an existing deployment, supply its **existing matching Bitrix encryption key** and database credentials. An arbitrary new encryption key can make existing encrypted data unreadable; changing a source setting does not rotate database credentials. Plan any rotation separately with backups and application-specific migration guidance.

Provision the matching TLS certificate chain and private key externally at `/etc/nginx/ssl/cert.pem`, as referenced by the existing nginx configuration. The tracked PEM is deliberately a non-deployable placeholder. Mount the real PEM read-only over that path; nginx cannot serve TLS until it is provisioned. Do not replace it with an invented key or copy a real key back into source control.

No live deployment or credential has been changed. Current-source sanitization does not remove credentials from Git history or make previously exposed values safe; historical cleanup and rotation require separate work.
