<?php
namespace AppBundle\Command;

use AppBundle\Entity\PropertyOwner;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class ImportPropertyInformationCommand extends ContainerAwareCommand {
    protected function configure()
    {
        $helpStr  = "This will import the CSV data into the database.";
        $this->setName("ontoprealty:import")
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
                    if($row < 3) {
                        $row++;
                        continue;
                    }
                    $row++;
                    $name         = $data[0];
                    $phoneNumbers = $data[1];
                    $email        = $data[2];
                    $properties   = $data[3];
                    $address      = $data[4];

                    $newProperty  = new PropertyOwner();
                    $newProperty->setName($name);
                    $newProperty->setPhoneNumbers($phoneNumbers);
                    $newProperty->setEmail($email);
                    $newProperty->setProperties($properties);
                    $newProperty->setAddress($address);
                    $em->persist($newProperty);
                    $em->flush();
                }
                fclose($handle);
            }
        } else {
            $output->writeln("Cannot find the CSV file, exiting.");
        }

        $output->writeln("Finished importing.");
    }

}