#!/bin/bash
rm -rf ~/backups/daily/*
tar czf ~/backups/daily/backup_`date +%Y_%m_%d`.tgz ~/public_html