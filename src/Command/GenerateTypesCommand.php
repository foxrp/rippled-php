<?php

namespace XRPHP\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class GenerateTypesCommand extends Command
{
    /** @var array */
    private $data;

    protected function configure(): void
    {
        $this
            ->setName('types')
            ->setDescription('Creates transaction types and common fields.')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): void
    {
        $this->data = json_decode(file_get_contents(__DIR__.'/../../rippled-spec/transactions.json'), true);
        $this->updateAbstract();
    }

    private function updateAbstract(): void
    {
        $code = '';
        foreach ($this->data['common_fields']['fields'] as $field) {
            $type = $field['name'];
            $req = isset($field['required']) && $field['required'] === true ? 'true' : 'false';
            $af = isset($field['auto_fillable']) && $field['auto_fillable'] === true ? 'true' : 'false';

            $code .= '        $this->addField(new TypeField([
            \'name\' => \'' . $type . '\',
            \'required\' => ' . $req . ',
            \'autoFillable\' => ' . $af . '
        ]));

';
        }

        $this->replaceCode(__DIR__.'/../Transaction/Type/AbstractType.php', $code);
    }

    private function replaceCode($file, $code): void
    {
        $content = file_get_contents($file);
        $search = "/\/\/\sBEGIN\sGENERATED(.*)END\sGENERATED/s";
        $replace = "// BEGIN GENERATED\n{$code}        // END GENERATED";

        $newContent = preg_replace($search, $replace, $content);
        file_put_contents($file, $newContent);
    }

}
