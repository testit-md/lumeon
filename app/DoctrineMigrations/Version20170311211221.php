<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20170311211221 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE patient (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, dob DATETIME NOT NULL, gender INT UNSIGNED NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE patients_doctor (patient_id INT NOT NULL, doctor_id INT NOT NULL, INDEX IDX_1549361B6B899279 (patient_id), INDEX IDX_1549361B87F4FB17 (doctor_id), PRIMARY KEY(patient_id, doctor_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE personnel_doctor (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE doctor_patients (doctor_id INT NOT NULL, patient_id INT NOT NULL, INDEX IDX_84385C1A87F4FB17 (doctor_id), INDEX IDX_84385C1A6B899279 (patient_id), PRIMARY KEY(doctor_id, patient_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE patients_doctor ADD CONSTRAINT FK_1549361B6B899279 FOREIGN KEY (patient_id) REFERENCES patient (id)');
        $this->addSql('ALTER TABLE patients_doctor ADD CONSTRAINT FK_1549361B87F4FB17 FOREIGN KEY (doctor_id) REFERENCES personnel_doctor (id)');
        $this->addSql('ALTER TABLE doctor_patients ADD CONSTRAINT FK_84385C1A87F4FB17 FOREIGN KEY (doctor_id) REFERENCES personnel_doctor (id)');
        $this->addSql('ALTER TABLE doctor_patients ADD CONSTRAINT FK_84385C1A6B899279 FOREIGN KEY (patient_id) REFERENCES patient (id)');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE patients_doctor DROP FOREIGN KEY FK_1549361B6B899279');
        $this->addSql('ALTER TABLE doctor_patients DROP FOREIGN KEY FK_84385C1A6B899279');
        $this->addSql('ALTER TABLE patients_doctor DROP FOREIGN KEY FK_1549361B87F4FB17');
        $this->addSql('ALTER TABLE doctor_patients DROP FOREIGN KEY FK_84385C1A87F4FB17');
        $this->addSql('DROP TABLE patient');
        $this->addSql('DROP TABLE patients_doctor');
        $this->addSql('DROP TABLE personnel_doctor');
        $this->addSql('DROP TABLE doctor_patients');
    }
}
