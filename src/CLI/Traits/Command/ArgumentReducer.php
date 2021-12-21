<?php

namespace Funnelnek\CLI\Traits\Command;

use BackedEnum;
use ReflectionClass;
use ReflectionObject;
use ReflectionEnumBackedCase;
use Funnelnek\CLI\ActionEvent;
use Funnelnek\CLI\Command\Exception\InvalidDispatchCommandException;

trait ArgumentReducer
{
    /**
     * Gets the command line arguments grouped by options and flags
     *
     * @param array|ActionEvent $service 
     * Either an array of injectable service where one of the service 
     * is an ActionEvent with an Action attribute of it's BackEnumCase or class.
     * Otherwise it must be an ActionEvent instance. - * Dependency Injectable **
     *
     * @return ActionEvent 
     */
    public static function reduce(array|ActionEvent $service): ActionEvent
    {
        $event = $service;

        // Filter out dependency injections.
        if (is_array($service)) {
            $event = array_filter($service, fn ($provider) => $provider instanceof ActionEvent);
            // Checks there if only one event passed and it's an instance of an ActionEvent.
            if (count($event) !== 1 || !is_a($event[0], ActionEvent::class)) {
                throw new InvalidDispatchCommandException();
            }
            $event = $event[0];
        }

        if (!is_a($event, ActionEvent::class)) {
            throw new InvalidDispatchCommandException();
        }

        $action = new ReflectionObject($event);
        $action = $action->getAttributes(Action::class);
        $action = array_shift($action);

        if ($action) {
            $action = $action->newInstance();

            if ($action->type instanceof BackedEnum) {

                $command = new ReflectionEnumBackedCase($action->type, $action->type::class);
                $dispatch = array_shift($command->getAttributes(Dispatch::class));

                if ($dispatch) {
                    $dispatch = $dispatch->newInstance();
                    $command = $dispatch->handler;
                    $service = new ReflectionClass($command);

                    // Checks if the action has a dispatch method.
                    if (!$service->hasProperty("dispatch")) {
                        $actionCreator = array_shift($service->getAttributes(ActionCreator::class));

                        if ($actionCreator) {
                        }
                    }
                }
            }

            if (is_array($event->type)) {
                foreach ($event->type as $action) {
                    if ($action instanceof BackedEnum) {
                        $action = new ReflectionEnumBackedCase($action, $action::class);
                    }
                }
            }
        }
    }
}
