<?php

namespace App\Form\DataTransformer;

use App\Enum\MachineStatus;
use Symfony\Component\Form\DataTransformerInterface;
use Symfony\Component\Form\Exception\TransformationFailedException;

class StringToMachineStatusTransformer implements DataTransformerInterface
{
    /**
     * Transforms an enum to a string.
     *
     * @param MachineStatus|null $status
     * @return string|null
     */
    public function transform($status): ?string
    {
        if (null === $status) {
            return '';
        }

        return $status->value;
    }

    /**
     * Transforms a string to an enum.
     *
     * @param string|null $statusString
     * @return MachineStatus|null
     * @throws TransformationFailedException if the transformation is not possible
     */
    public function reverseTransform($statusString): ?MachineStatus
    {
        if (!$statusString) {
            return null;
        }

        $status = MachineStatus::tryFrom($statusString);

        if (null === $status) {
            throw new TransformationFailedException(sprintf(
                'The status "%s" is not a valid status',
                $statusString
            ));
        }

        return $status;
    }
}