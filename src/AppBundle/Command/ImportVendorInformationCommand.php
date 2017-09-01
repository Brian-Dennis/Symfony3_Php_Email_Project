<?php
/**
 * Created by PhpStorm.
 * User: brian
 * Date: 10/11/16
 * Time: 2:45 PM
 */
namespace AppBundle\Command;

use AppBundle\Entity\Vendor;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class ImportVendorInformationCommand extends ContainerAwareCommand {
    protected function configure()
    {
        $helpStr  = "This will import the CSV data into the database.";
        $this->setName("vendor:import")
            ->setHelp($helpStr)
            ->setDescription("Imports the data from the CSV into the database")
            ->addArgument('filename', InputArgument::REQUIRED, "This is the filename of the CSV file. Assumed relative.")
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $em           = $this->getContainer()->get('doctrine')->getManager();

        $output->writeln("Starting the import task.");
        $csvFilePath = $input->getArgument('filename');
        if(file_exists($csvFilePath)) {
            $output->writeln("Found the CSV file, attempting to read.");
            $row = 1; //data starts on line 3
            if (($handle = fopen($csvFilePath, "r")) !== FALSE) {
                while (($data = fgetcsv($handle, 0, ",")) !== FALSE) {
                    if ($row < 3) {
                        $row++;
                        continue;
                    }

                    $vendor = $data[2];
                    $row++;
                    if(!empty($vendor)) {
                        $jobType = $data[1];
                        $contact = $data[3];
                        $phonenumber = $data[4];
                        $email = $data[5];

                        $newVendor = new Vendor();
                        $newVendor->setJobType($jobType);
                        $newVendor->setVendor($vendor);
                        $newVendor->setContact($contact);
                        $newVendor->setPhonenumber($phonenumber);
                        $newVendor->setEmail($email);
                        $em->persist($newVendor);
                        $em->flush();
                    }
                }
                fclose($handle);
            }
        } else {
            $output->writeln("Cannot find the CSV file, exiting.");
        }

        $output->writeln("Finished importing.");
    }

}